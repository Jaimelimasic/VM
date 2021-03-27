window.onload = function () {
    // COMMON PART
    var player;
    const manifestAnalysisUrl = "https://media-analysis.azurewebsites.net/api/ManifestAnalysis";

    const videoPlayer = document.querySelector('#videoPlayer');

    const $dashUrl = $('#dash-url');
    const $hlsUrl = $('#hls-url');
    const $token = $('#token');
    const $certUrl = $('#hls-cert-url');
    const $wvLicenseServer = $('#wv-license-server');
    const $prLicenseServer = $('#pr-license-server');
    const $fpLicenseServer = $('#fp-license-server');
    const $kid = $('#kid');

    const $wvLicenseServerDropdown = $('#wv-license-server-dropdown');
    const $prLicenseServerDropdown = $('#pr-license-server-dropdown');
    const $fpLicenseServerDropdown = $('#fp-license-server-dropdown');

    const $audioSelect = $('#audioTracks');
    const $subtitleSelect = $('#subtitleTracks');
    const unsubscribe = [];

    var activeTextTrack;

   

 
  openPlayer();

    function setUrlParams(ob) {
        var str = "";
        for (var key in ob) {
            if (str != "") {
                str += "&";
            }
            str += key + "=" + encodeURIComponent(ob[key]);
        }
        window.history.pushState("", "", window.location.pathname + "?" + str);
    }


    function getQueryParams(qs) { 
        qs = qs.split('+').join(' ');
        var params = {},
            tokens,
            re = /[?&]?([^=]+)=([^&]*)/g;
        while (tokens = re.exec(qs)) {
            params[decodeURIComponent(tokens[1])] = decodeURIComponent(tokens[2]);
        }
        return params;
    }

    // BOTTOM PANEL

    function audioSelect() {
        audioTracks = player.getAvailableAudioTracks();
        for (var i = 0; i < audioTracks.length; i++) {
            $audioSelect
                .append($("<option></option>")
                .attr("value", audioTracks[i].index)
                .text(audioTracks[i].languageCode));
        }

        $audioSelect.on('change', setAudioTrack);
    }

    function setAudioTrack() {
        var trackId = $audioSelect.find(":selected").val();
        player.setAudioTrack(parseInt(trackId));
    }

    function createSubtitleSwitch() {
        setTimeout(function() {
            var subtitleTracks = player.getAvailableTextTracks();

            if (subtitleTracks.length === 0) {
                subtitlesOff();
                return;
            }

            subtitlesOff();

            for (var i = 0; i < subtitleTracks.length; i++) {
                var textTrack = subtitleTracks[i];

                $subtitleSelect
                     .append($("<option></option>")
                     .attr("value", textTrack.index)
                     .text(textTrack.languageCode));
            }

            $subtitleSelect.change(function () {
                subtitlesOn();
                hideTextTracks();
                var track = parseInt($subtitleSelect.find(":selected").val());
                activeTextTrack = track;
                player.setTextTrack(track);
            });
        }, 50);
    }

    function hideTextTracks() {
        player.setTextTrack(-1);
    }

    function subtitlesOn() {
        if (player.getAvailableTextTracks().length === 0) {
            subtitlesOff();
            return;
        }
        if (!$('#subtitles .on').hasClass('btn-primary')) {
            $('#subtitles .on').addClass('btn-primary');
            $('#subtitles .off').removeClass('btn-primary');
        }
        if(activeTextTrack)
            player.setTextTrack(activeTextTrack);
        else 
            player.setTextTrack(0);
    }

    function subtitlesOff() {
        if (!$('#subtitles .off').hasClass('btn-primary')) {
            $('#subtitles .off').addClass('btn-primary');
            $('#subtitles .on').removeClass('btn-primary');
            player.setTextTrack(-1);
        }
    }

    function dataLoaded() {
        audioSelect();
        createSubtitleSwitch();
        $('#subtitles .on').on('click', subtitlesOn);
        $('#subtitles .off').on('click', subtitlesOff);
    }

    // PLAYER SPECIFIC PART
    function openPlayer() {
        if (player) {
            console.info('PlayerService: player instance already exists');
            player.destroy();
            $audioSelect.html('');
            $subtitleSelect.html('');
            player = null;
            removeEventListeners();
            console.info('PlayerService: destroyed!');
        }

        setUrlParams({
            dashUrl: $dashUrl.val(),
            hlsUrl: $hlsUrl.val(),
            wvlicense: $wvLicenseServer.val(),
            prlicense: $prLicenseServer.val(),
            fplicense: $fpLicenseServer.val(),
            token: $token.val(),
            certUrl: $certUrl.val(),
            kid: $kid.val()
        });

        if($token.val() === '' && $wvLicenseServer.val() !== '') {
            getEntitlement($dashUrl.val(), function(token) {
                initPlayer(token);
            });
        } else {
            // Either unprotected or entitlement token already present
            initPlayer($token.val());
        }
    }

    function getEntitlement(url, cb) {
        function getToken(keyId, cb) {
            $.get("https://axdrmmg.axinom.com/api/token/" + keyId, function (token) {
                console.info('Token received, building protection data and initializing player!');
                cb(token);
            });
        }
    
        function manifestAnalysis(url, cb) {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', manifestAnalysisUrl + '/?url=' + url);
            xhr.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    var data = JSON.parse(this.response);
                    if (data.KeyIds.length === 0) {
                        console.info('No keys found, trying to play video without token');
                        cb();
                    } else {
                        console.info("Got key, going for token");
                        getToken(data.KeyIds[0], cb);
                    }
                    return;
                }
                if (this.readyState === 4 && this.status === 500) {
                    console.info("Couldn't get key with URL post, trying again by posting MPD");
                    getMpd(url, cb);
                    return;
                }
            };
            xhr.send();
        }
    
        function getMpd(url, cb) {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', url);
            xhr.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    console.info('Got MPD, asking for key');
                    mpdManifestAnalysis(xhr.responseXML, cb);
                }
                if (this.readyState === 4 && this.status === 500) {
                    console.error('No stream found on the url: ' + url);
                }
            };
            xhr.send();
        }
    
        function mpdManifestAnalysis(mpd, cb) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', manifestAnalysisUrl);
            xhr.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    var data = JSON.parse(this.response);
                    if (data.KeyIds.length === 0) {
                        console.info('No keys found, trying to play video without token');
                        cb();
                    } else {
                        console.info("Got key, going for token");
                        getToken(data.KeyIds[0]);
                    }
                    return;
                }
                if (this.readyState === 4 && this.status === 500) {
                    console.warn("Couldn't get ID by sending manifest");
                }
            };
            xhr.send(mpd);
        }

        manifestAnalysis(url, cb);
    }

    function initPlayer(token) {
        var url = {
            dash: $dashUrl.val(),
            hls: $hlsUrl.val()
        };

        var parameters = {
            autoplay: true,
            licenseServers: {
                playready: $prLicenseServer.val(),
                widevine: $wvLicenseServer.val(),
                fairplay: $fpLicenseServer.val(),
            },
            entitlementToken: token,
            fpsCertificateUrl: $certUrl.val()
        };
        player = new axinom.video.VideoPlayer();
        
        window.player = player; //For debugging

        addEventListeners();

        try {
            console.info('PlayerService: play video');
            player.setPlayerView(videoPlayer);
            player.prepareVideo(url, parameters);
        } catch (error) {
            console.log(error);
            throw new Error('PlayerService: Cannot start video');
        }

        $('#player').show();
    }


    // LOGGING

    function addEventListeners() {
        console.info('PlayerService: subscribing to video events');
        unsubscribe.push(player.subscribe(axinom.video.VideoEventName.VideoEnded, onVideoEnded.bind(this)));
        unsubscribe.push(player.subscribe(axinom.video.VideoEventName.StateChanged, onStateChanged.bind(this)));
        unsubscribe.push(player.subscribe(axinom.video.VideoEventName.VolumeChanged, onVolumeChange.bind(this)));
        unsubscribe.push(player.subscribe(axinom.video.VideoEventName.AudioTrackChanged, onAudioTrackChange.bind(this)));
        unsubscribe.push(player.subscribe(axinom.video.VideoEventName.BufferingStatusChanged, onBufferingStatusChanged.bind(this)));
        unsubscribe.push(player.subscribe(axinom.video.VideoEventName.BitrateChanged, onBitrateChanged.bind(this)));
        unsubscribe.push(player.subscribe(axinom.video.VideoEventName.Seeked, onSeeked.bind(this)));
        unsubscribe.push(player.subscribe(axinom.video.VideoEventName.SubtitlesTrackChanged, onSubtitleTrackChange.bind(this)));
        unsubscribe.push(player.subscribe(axinom.video.VideoEventName.Error, onError.bind(this)));
        unsubscribe.push(player.subscribe(axinom.video.VideoEventName.DebugInfo, onDebugInfo.bind(this)));
    }

    function removeEventListeners() {
        console.log('PlayerService: unsubscribing from video events');
        for (var i = 0; i < unsubscribe.length; i++) {
            if (typeof unsubscribe[i] === 'function') {
                unsubscribe[i]();
            }
        }
        unsubscribe.length = 0; // clear
    }

    function onStateChanged(event) {
        console.log(axinom.video.VideoEventName.StateChanged + ': ' + JSON.stringify(event));

        if (event.state == "PREPARED") {
            dataLoaded();
        }
    }

    function onVolumeChange(event) {
        console.log(axinom.video.VideoEventName.VolumeChanged + ': ' + JSON.stringify(event));
    }

    function onAudioTrackChange(event) {
        console.log(axinom.video.VideoEventName.AudioTrackChanged + ': ' + JSON.stringify(event));
    }

    function onSubtitleTrackChange(event) {
        console.log(axinom.video.VideoEventName.SubtitlesTrackChanged + ': ' + JSON.stringify(event));
    }

    function onBufferingStatusChanged(event) {
        console.log(axinom.video.VideoEventName.BufferingStatusChanged + ': ' + JSON.stringify(event));
    }

    function onBitrateChanged(event) {
        console.log(axinom.video.VideoEventName.BitrateChanged + ': ' + JSON.stringify(event));
    }

    function onSeeked(event) {
        console.log(axinom.video.VideoEventName.Seeked + ': ' + JSON.stringify(event));
    }

    function onVideoEnded(event) {
        console.log(axinom.video.VideoEventName.VideoEnded + ': ' + JSON.stringify(event));
    }

    function onError(event) {
        console.log(axinom.video.VideoEventName.Error + ': ' + JSON.stringify(event));
    }

    function onDebugInfo(event) {
        console.log(axinom.video.VideoEventName.DebugInfo + ': ' + JSON.stringify(event));
    }
}