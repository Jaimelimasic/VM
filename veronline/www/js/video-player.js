! function(e, t) {
    "object" == typeof exports && "object" == typeof module ? module.exports = t(require("shaka-player")) : "function" == typeof define && define.amd ? define(["shaka-player"], t) : "object" == typeof exports ? exports.video = t(require("shaka-player")) : (e.axinom = e.axinom || {}, e.axinom.video = t(e["shaka-player"]))
}(this, function(e) {
    return function(e) {
        var t = {};

        function n(r) {
            if (t[r]) return t[r].exports;
            var i = t[r] = {
                i: r,
                l: !1,
                exports: {}
            };
            return e[r].call(i.exports, i, i.exports, n), i.l = !0, i.exports
        }
        return n.m = e, n.c = t, n.d = function(e, t, r) {
            n.o(e, t) || Object.defineProperty(e, t, {
                configurable: !1,
                enumerable: !0,
                get: r
            })
        }, n.n = function(e) {
            var t = e && e.__esModule ? function() {
                return e.default
            } : function() {
                return e
            };
            return n.d(t, "a", t), t
        }, n.o = function(e, t) {
            return Object.prototype.hasOwnProperty.call(e, t)
        }, n.p = "", n(n.s = 6)
    }([function(e, t, n) {
        "use strict";
        Object.defineProperty(t, "__esModule", {
            value: !0
        });
        var r = n(9);
        t.AxPlayerState = r.AxPlayerState, t.AxPlayerStateInitiator = r.AxPlayerStateInitiator;
        var i = n(10);
        t.VideoEventName = i.VideoEventName;
        var a = n(5);
        t.LicenseRequestTypes = a.LicenseRequestTypes
    }, function(e, t, n) {
        "use strict";
        Object.defineProperty(t, "__esModule", {
            value: !0
        });
        var r = {};
        t.subscribe = function(e, t) {
            return function(e, t) {
                return r[e] || (r[e] = []), r[e].push(t),
                    function() {
                        var n = r[e];
                        if (n) {
                            var i = n.indexOf(t);
                            n.splice(i, 1)
                        }
                    }
            }(e, t)
        }, t.publish = function(e, t) {
            r[e] && r[e].forEach(function(e) {
                e(t)
            })
        }, t.unsubscribeAll = function() {
            for (var e in r) r.hasOwnProperty(e) && delete r[e]
        }
    }, function(e, t, n) {
        "use strict";
        Object.defineProperty(t, "__esModule", {
            value: !0
        });
        var r = n(14);
        t.AudioChangedEvent = r.AudioChangedEvent;
        var i = n(15);
        t.ErrorEvent = i.ErrorEvent;
        var a = n(16);
        t.SeekedEvent = a.SeekedEvent;
        var o = n(17);
        t.StateChangedEvent = o.StateChangedEvent;
        var s = n(18);
        t.BitrateChangedEvent = s.BitrateChangedEvent;
        var u = n(19);
        t.BufferingStatusChangedEvent = u.BufferingStatusChangedEvent;
        var d = n(20);
        t.TextChangedEvent = d.TextChangedEvent;
        var l = n(21);
        t.SubtitlesChangedEvent = l.SubtitlesChangedEvent;
        var c = n(22);
        t.VolumeChangedEvent = c.VolumeChangedEvent;
        var p = n(23);
        t.DebugInfoEvent = p.DebugInfoEvent
    }, function(e, t, n) {
        "use strict";
        Object.defineProperty(t, "__esModule", {
            value: !0
        });
        var r = function() {
            return function(e, t, n) {
                this.code = e, this.errorDescription = t, this.originalError = n
            }
        }();
        t.AxPlayerError = r
    }, function(e, t, n) {
        "use strict";
        Object.defineProperty(t, "__esModule", {
                value: !0
            }),
            function(e) {
                e.Caption = "ClosedCaption", e.Subtitle = "Subtitle", e.Other = "Other"
            }(t.AxTrackType || (t.AxTrackType = {}))
    }, function(e, t, n) {
        "use strict";
        Object.defineProperty(t, "__esModule", {
                value: !0
            }),
            function(e) {
                e.Widevine_PlayReady = "widevine_playready", e.FairPlay = "fairplay"
            }(t.LicenseRequestTypes || (t.LicenseRequestTypes = {}))
    }, function(e, t, n) {
        "use strict";
        var r = this && this.__decorate || function(e, t, n, r) {
                var i, a = arguments.length,
                    o = a < 3 ? t : null === r ? r = Object.getOwnPropertyDescriptor(t, n) : r;
                if ("object" == typeof Reflect && "function" == typeof Reflect.decorate) o = Reflect.decorate(e, t, n, r);
                else
                    for (var s = e.length - 1; s >= 0; s--)(i = e[s]) && (o = (a < 3 ? i(o) : a > 3 ? i(t, n, o) : i(t, n)) || o);
                return a > 3 && o && Object.defineProperty(t, n, o), o
            },
            i = this && this.__metadata || function(e, t) {
                if ("object" == typeof Reflect && "function" == typeof Reflect.metadata) return Reflect.metadata(e, t)
            };
        Object.defineProperty(t, "__esModule", {
            value: !0
        });
        var a = n(3),
            o = n(7),
            s = n(0),
            u = n(1),
            d = n(11),
            l = n(12),
            c = n(13),
            p = n(2),
            h = n(26);
        ! function(e) {
            for (var n in e) t.hasOwnProperty(n) || (t[n] = e[n])
        }(n(0));
        var f = function() {
            function e() {}
            return e.prototype.setPlayerView = function(e) {
                !e || this.view ? this.reportError("Failed to set player view - view parameter missing or already set!") : u.publish(s.VideoEventName.DebugInfo, new p.DebugInfoEvent("Info", "Player view set")), this.view = e
            }, e.prototype.destroy = function() {
                this.player && (this.player.destroy(), this.player = null), this.view = null, this.videoUrl = null, this.parameters = null, u.unsubscribeAll()
            }, e.prototype.prepareVideo = function(e, t) {
                (null == e || Object.keys(e).length <= 0) && this.reportError("Cannot prepare video - no video URLs provided!"), this.videoUrl = e, this.sanitizeParameters(t), this.startPlayback()
            }, e.prototype.subscribe = function(e, t) {
                return u.subscribe(e, t)
            }, e.prototype.play = function() {
                this.player.play()
            }, e.prototype.pause = function() {
                this.player.pause()
            }, e.prototype.seekTo = function(e) {
                if ("number" != typeof e || isNaN(e)) u.publish(s.VideoEventName.DebugInfo, new p.DebugInfoEvent("Warning", "Invalid seek position - value is not a number!"));
                else {
                    var t = this.getDuration();
                    e > t || e < 0 ? u.publish(s.VideoEventName.DebugInfo, new p.DebugInfoEvent("Warning", "Seek position " + e + " is out out of boundaries 0 - " + t)) : this.player.seek(e)
                }
            }, e.prototype.setSubtitleTrack = function(e) {
                u.publish(s.VideoEventName.DebugInfo, new p.DebugInfoEvent("Info", "This method is deprecated, please use setTextTrack")), this.setTextTrack(e)
            }, e.prototype.setTextTrack = function(e) {
                "number" != typeof e || isNaN(e) ? u.publish(s.VideoEventName.DebugInfo, new p.DebugInfoEvent("Warning", "Invalid track index - value is not a number!")) : this.player.textTracks.length < 1 ? u.publish(s.VideoEventName.DebugInfo, new p.DebugInfoEvent("Warning", "Could not select text track - no tracks available")) : e > this.player.textTracks.length - 1 || e < -1 && -1 !== e ? u.publish(s.VideoEventName.DebugInfo, new p.DebugInfoEvent("Warning", "Selected text track index " + e + " out of boundaries 0 - " + (this.player.textTracks.length - 1))) : this.player.setTextTrack(e)
            }, e.prototype.setSubtitleLanguage = function(e) {
                u.publish(s.VideoEventName.DebugInfo, new p.DebugInfoEvent("Info", "This method is deprecated, please use setTextLanguage")), this.setTextLanguage(e)
            }, e.prototype.setTextLanguage = function(e) {
                var t = this.player.textTracks.findIndex(function(t) {
                    return t.languageCode === e.toLowerCase()
                });
                t > -1 ? this.player.setTextTrack(t) : u.publish(s.VideoEventName.DebugInfo, new p.DebugInfoEvent("Warning", "Could not find subtitle with submitted language code"))
            }, e.prototype.setAudioTrack = function(e) {
                "number" != typeof e || isNaN(e) ? u.publish(s.VideoEventName.DebugInfo, new p.DebugInfoEvent("Warning", "Invalid track index - value is not a number!")) : this.player.audioTracks.length < 1 ? u.publish(s.VideoEventName.DebugInfo, new p.DebugInfoEvent("Warning", "Could not select audio track - no tracks available")) : e > this.player.audioTracks.length - 1 || e < 0 ? u.publish(s.VideoEventName.DebugInfo, new p.DebugInfoEvent("Warning", "Selected audio track index " + e + " out of boundaries 0 - " + (this.player.audioTracks.length - 1))) : this.player.setAudioTrack(e)
            }, e.prototype.setAudioLanguage = function(e) {
                var t = this.player.audioTracks.findIndex(function(t) {
                    return t.languageCode === e.toLowerCase()
                });
                t > -1 ? this.player.setAudioTrack(t) : u.publish(s.VideoEventName.DebugInfo, new p.DebugInfoEvent("Warning", "Could not find audio with submitted language code"))
            }, e.prototype.getVersion = function() {
                return l.version
            }, e.prototype.getDuration = function() {
                return this.player.duration
            }, e.prototype.getVolume = function() {
                return this.player.volume
            }, e.prototype.setVolume = function(e) {
                if ("number" != typeof e || isNaN(e)) u.publish(s.VideoEventName.DebugInfo, new p.DebugInfoEvent("Warning", "Invalid volume level - value is not a number!"));
                else {
                    var t = Math.min(Math.max(e, 0), 1);
                    this.player.setVolume(t), e !== t && u.publish(s.VideoEventName.DebugInfo, new p.DebugInfoEvent("Warning", "Volume level set to " + t + ", selected level " + e + " out of boundaries 0 - 1"))
                }
            }, e.prototype.getPlayerState = function() {
                return this.player.playerState
            }, e.prototype.getCurrentPosition = function() {
                return this.player.position
            }, e.prototype.getAvailableAudioTracks = function() {
                return this.player.audioTracks
            }, e.prototype.getAvailableTextTracks = function() {
                return this.player.textTracks
            }, e.prototype.getAvailableSubtitleTracks = function() {
                return u.publish(s.VideoEventName.DebugInfo, new p.DebugInfoEvent("Info", "This method is deprecated, please use getAvailableTextTracks")), this.getAvailableTextTracks()
            }, e.prototype.getCurrentAudioTrack = function() {
                return this.player.currentAudioTrack
            }, e.prototype.getCurrentTextTrack = function() {
                return this.player.currentTextTrack
            }, e.prototype.getCurrentSubtitleTrack = function() {
                return u.publish(s.VideoEventName.DebugInfo, new p.DebugInfoEvent("Info", "This method is deprecated, please use getCurrentTextTrack")), this.getCurrentTextTrack()
            }, e.prototype.getCurrentBitrate = function() {
                return this.player.getCurrentBitrate()
            }, e.prototype.isBuffering = function() {
                return this.player.isBuffering()
            }, e.prototype.startPlayback = function() {
                if (!d.isSafari && this.videoUrl.dash) u.publish(s.VideoEventName.DebugInfo, new p.DebugInfoEvent("Info", "DASH manifest provided, using Shaka for playback")), this.player = new c.AdaptiveMediaPlayer(this.view, this.videoUrl.dash, this.parameters, this.onLicenseRequest.bind(this));
                else if ("" !== d.isHLSSupported && this.videoUrl.hls) u.publish(s.VideoEventName.DebugInfo, new p.DebugInfoEvent("Info", "HLS manifest provided, capability - " + d.isHLSSupported)), this.player = new h.WebVideoPlayer(this.view, this.videoUrl.hls, this.parameters, this.onLicenseRequest.bind(this));
                else {
                    if (!this.videoUrl.mp4 && !this.videoUrl.webm) throw new Error("No browser support for any of the provided video URLs, aborting playback!");
                    u.publish(s.VideoEventName.DebugInfo, new p.DebugInfoEvent("Info", "Single file provided, using HTML5 video for playback")), this.player = new h.WebVideoPlayer(this.view, this.videoUrl.mp4 ? this.videoUrl.mp4 : this.videoUrl.webm, this.parameters, this.onLicenseRequest.bind(this))
                }
            }, e.prototype.onLicenseRequest = function(e) {
                return !!this.LicenseRequestPreparationCallback && (this.LicenseRequestPreparationCallback(e), !0)
            }, e.prototype.sanitizeParameters = function(e) {
                var t = this;
                this.parameters = {
                    licenseServers: null,
                    entitlementToken: null,
                    fpsCertificateUrl: null,
                    minimumBitrate: Number.MIN_SAFE_INTEGER,
                    maximumBitrate: Number.MAX_SAFE_INTEGER,
                    autoPlay: !0,
                    selectedAudioTrack: null,
                    selectedAudioLanguage: null,
                    selectedTextTrack: null,
                    selectedTextLanguage: null,
                    startPosition: 0,
                    selectedSubtitleTrack: null,
                    selectedSubtitleLanguage: null
                }, e && Object.keys(this.parameters).forEach(function(n) {
                    void 0 !== e[n] && null !== e[n] && (t.parameters[n] = e[n])
                })
            }, e.prototype.reportError = function(e, t) {
                throw void 0 === t && (t = null), t || (t = new Error(e)), u.publish(s.VideoEventName.Error, new p.ErrorEvent(new a.AxPlayerError("", e, t))), t
            }, r([v, i("design:type", Function), i("design:paramtypes", [Object, Object]), i("design:returntype", void 0)], e.prototype, "prepareVideo", null), r([v, i("design:type", Function), i("design:paramtypes", []), i("design:returntype", void 0)], e.prototype, "play", null), r([v, i("design:type", Function), i("design:paramtypes", []), i("design:returntype", void 0)], e.prototype, "pause", null), r([v, i("design:type", Function), i("design:paramtypes", [Number]), i("design:returntype", void 0)], e.prototype, "seekTo", null), r([v, i("design:type", Function), i("design:paramtypes", [Number]), i("design:returntype", void 0)], e.prototype, "setSubtitleTrack", null), r([v, i("design:type", Function), i("design:paramtypes", [Number]), i("design:returntype", void 0)], e.prototype, "setTextTrack", null), r([v, i("design:type", Function), i("design:paramtypes", [String]), i("design:returntype", void 0)], e.prototype, "setSubtitleLanguage", null), r([v, i("design:type", Function), i("design:paramtypes", [String]), i("design:returntype", void 0)], e.prototype, "setTextLanguage", null), r([v, i("design:type", Function), i("design:paramtypes", [Number]), i("design:returntype", void 0)], e.prototype, "setAudioTrack", null), r([v, i("design:type", Function), i("design:paramtypes", [String]), i("design:returntype", void 0)], e.prototype, "setAudioLanguage", null), r([v, i("design:type", Function), i("design:paramtypes", []), i("design:returntype", Number)], e.prototype, "getDuration", null), r([v, i("design:type", Function), i("design:paramtypes", []), i("design:returntype", Number)], e.prototype, "getVolume", null), r([v, i("design:type", Function), i("design:paramtypes", [Number]), i("design:returntype", void 0)], e.prototype, "setVolume", null), r([v, i("design:type", Function), i("design:paramtypes", []), i("design:returntype", String)], e.prototype, "getPlayerState", null), r([v, i("design:type", Function), i("design:paramtypes", []), i("design:returntype", Number)], e.prototype, "getCurrentPosition", null), r([v, i("design:type", Function), i("design:paramtypes", []), i("design:returntype", Array)], e.prototype, "getAvailableAudioTracks", null), r([v, i("design:type", Function), i("design:paramtypes", []), i("design:returntype", Array)], e.prototype, "getAvailableTextTracks", null), r([v, i("design:type", Function), i("design:paramtypes", []), i("design:returntype", Array)], e.prototype, "getAvailableSubtitleTracks", null), r([v, i("design:type", Function), i("design:paramtypes", []), i("design:returntype", o.AxTrack)], e.prototype, "getCurrentAudioTrack", null), r([v, i("design:type", Function), i("design:paramtypes", []), i("design:returntype", o.AxTrack)], e.prototype, "getCurrentTextTrack", null), r([v, i("design:type", Function), i("design:paramtypes", []), i("design:returntype", o.AxTrack)], e.prototype, "getCurrentSubtitleTrack", null), r([v, i("design:type", Function), i("design:paramtypes", []), i("design:returntype", Number)], e.prototype, "getCurrentBitrate", null), r([v, i("design:type", Function), i("design:paramtypes", []), i("design:returntype", Boolean)], e.prototype, "isBuffering", null), e
        }();

        function v(e, t, n) {
            var r = n.value;
            n.value = function() {
                for (var e = [], t = 0; t < arguments.length; t++) e[t] = arguments[t];
                this.view || this.reportError("Player view is missing! Provide HTMLVideoElement before interacting with the player.");
                try {
                    return r.apply(this, e)
                } catch (e) {
                    e ? this.reportError(e.message ? e.message : "Player error", e) : console.log("An unknown error has occured!")
                }
            }
        }
        t.VideoPlayer = f
    }, function(e, t, n) {
        "use strict";
        Object.defineProperty(t, "__esModule", {
            value: !0
        });
        var r = n(4),
            i = function() {
                return function(e, t, n) {
                    void 0 === e && (e = -1), void 0 === n && (n = r.AxTrackType.Other), this.index = e, this.languageCode = t, this.type = n
                }
            }();
        t.AxTrack = i
    }, function(e, t, n) {
        "use strict";
        Object.defineProperty(t, "__esModule", {
            value: !0
        });
        var r = n(3),
            i = n(7),
            a = n(0),
            o = n(1),
            s = n(2),
            u = function() {
                function e() {
                    var e = this;
                    this.playerState = a.AxPlayerState.NEW, this.volume = 1, this.duration = 0, this.position = 0, this.pausedByUser = !0, this.textTracks = [], this.audioTracks = [], this.currentAudioTrack = null, this.currentTextTrack = null, this.seekedFrom = 0, this.seekedTo = 0, this.isSeeking = !1, this.previousBitrate = 0, this.onError = function(t, n) {
                        throw void 0 === n && (n = ""), o.publish(a.VideoEventName.Error, new s.ErrorEvent(new r.AxPlayerError(t ? t.code : "", n, t))), e.changePlayerState(a.AxPlayerState.FAILED), t
                    }, this.onEnded = function(t) {
                        e.playerState !== a.AxPlayerState.PAUSED && e.onPause(t), o.publish(a.VideoEventName.VideoEnded, null)
                    }, this.onSeeking = function(t) {
                        e.seekedTo = 1e3 * t.target.currentTime
                    }, this.onSeeked = function(t) {
                        o.publish(a.VideoEventName.Seeked, new s.SeekedEvent(e.seekedFrom, e.seekedTo))
                    }, this.onPlaying = function(t) {
                        e.playerState !== a.AxPlayerState.PLAYING && (e.changePlayerState(a.AxPlayerState.PLAYING, e.pausedByUser ? a.AxPlayerStateInitiator.USER : a.AxPlayerStateInitiator.APP), e.pausedByUser = !1)
                    }, this.onPause = function(t) {
                        e.changePlayerState(a.AxPlayerState.PAUSED, e.pausedByUser ? a.AxPlayerStateInitiator.USER : a.AxPlayerStateInitiator.APP)
                    }, this.onVolumeChange = function(t) {
                        e.volume = t.target.volume, o.publish(a.VideoEventName.VolumeChanged, new s.VolumeChangedEvent(e.volume))
                    }, this.onTimeupdate = function(t) {
                        e.position = 1e3 * t.target.currentTime, e.position > e.duration && (e.position = e.duration)
                    }, this.onConnected = function(t) {
                        e.play()
                    }, this.onDisconnected = function(t) {
                        e.onError(null, "Player disconnected from network")
                    }
                }
                return e.prototype.play = function() {
                    var e = this,
                        t = this.videoElement.play();
                    void 0 !== t ? t.then(function() {}).catch(function(t) {
                        o.publish(a.VideoEventName.DebugInfo, new s.DebugInfoEvent("Info", "Programmatic playback failed - user interaction needed!")), e.changePlayerState(a.AxPlayerState.PLAYBACK_NOT_ALLOWED)
                    }) : this.videoElement.play()
                }, e.prototype.pause = function() {
                    this.pausedByUser = !0, this.videoElement.pause()
                }, e.prototype.setVolume = function(e) {
                    this.videoElement.volume = e
                }, e.prototype.seek = function(e) {
                    this.seekedFrom = 1e3 * this.videoElement.currentTime, this.videoElement.currentTime = e / 1e3
                }, e.prototype.changePlayerState = function(e, t) {
                    void 0 === t && (t = a.AxPlayerStateInitiator.APP), this.playerState = e, o.publish(a.VideoEventName.StateChanged, new s.StateChangedEvent(this.playerState, t))
                }, e.prototype.formatTracks = function(e, t) {
                    var n = [];
                    for (var r in e)
                        if (e.hasOwnProperty(r) && e[r].language) {
                            var a = new i.AxTrack(n.length, e[r].language.toLowerCase(), t(e[r]));
                            n.push(a)
                        } return n
                }, e.prototype.addBaseEventListeners = function() {
                    this.videoElement.addEventListener("ended", this.onEnded), this.videoElement.addEventListener("error", this.onError), this.videoElement.addEventListener("seeking", this.onSeeking), this.videoElement.addEventListener("seeked", this.onSeeked), this.videoElement.addEventListener("playing", this.onPlaying), this.videoElement.addEventListener("pause", this.onPause), this.videoElement.addEventListener("timeupdate", this.onTimeupdate), this.videoElement.addEventListener("volumechange", this.onVolumeChange), window.addEventListener("online", this.onConnected), window.addEventListener("offline", this.onDisconnected)
                }, e.prototype.removeBaseEventListeners = function() {
                    this.videoElement.removeEventListener("ended", this.onEnded), this.videoElement.removeEventListener("error", this.onError), this.videoElement.removeEventListener("seeking", this.onSeeking), this.videoElement.removeEventListener("seeked", this.onSeeked), this.videoElement.removeEventListener("playing", this.onPlaying), this.videoElement.removeEventListener("pause", this.onPause), this.videoElement.removeEventListener("timeupdate", this.onTimeupdate), this.videoElement.removeEventListener("volumechange", this.onVolumeChange), window.removeEventListener("online", this.onConnected), window.removeEventListener("offline", this.onDisconnected)
                }, e
            }();
        t.VideoPlayerBase = u
    }, function(e, t, n) {
        "use strict";
        Object.defineProperty(t, "__esModule", {
                value: !0
            }),
            function(e) {
                e.NEW = "NEW", e.PREPARING = "PREPARING", e.PREPARED = "PREPARED", e.PLAYING = "PLAYING", e.PAUSED = "PAUSED", e.FAILED = "FAILED", e.PLAYBACK_NOT_ALLOWED = "PLAYBACK_NOT_ALLOWED"
            }(t.AxPlayerState || (t.AxPlayerState = {})),
            function(e) {
                e.APP = "APP", e.USER = "USER"
            }(t.AxPlayerStateInitiator || (t.AxPlayerStateInitiator = {}))
    }, function(e, t, n) {
        "use strict";
        Object.defineProperty(t, "__esModule", {
                value: !0
            }),
            function(e) {
                e.VideoEnded = "VIDEO_ENDED", e.StateChanged = "STATE_CHANGED", e.BufferingStatusChanged = "BUFFERING_STATUS_CHANGED", e.BitrateChanged = "BITRATE_CHANGED", e.SubtitlesTrackChanged = "SUBTITLES_TRACK_CHANGED", e.TextTrackChanged = "TEXT_TRACK_CHANGED", e.AudioTrackChanged = "AUDIO_TRACK_CHANGED", e.VolumeChanged = "VOLUME_CHANGED", e.Error = "ERROR", e.Seeked = "SEEKED", e.DebugInfo = "DEBUG_INFO"
            }(t.VideoEventName || (t.VideoEventName = {}))
    }, function(e, t, n) {
        "use strict";
        Object.defineProperty(t, "__esModule", {
            value: !0
        }), t.isHLSSupported = document.createElement("video").canPlayType('application/x-mpegURL; codecs="avc1.42E01E"'), t.isMac = !!navigator.platform.match(/(Mac|iPhone|iPod|iPad)/i), t.isSafari = /^((?!chrome|android).)*safari/i.test(navigator.userAgent), t.browserHasMSE = "MediaSource" in window
    }, function(e, t, n) {
        "use strict";
        Object.defineProperty(t, "__esModule", {
            value: !0
        });
        t.version = "3.3.1913501"
    }, function(e, t, n) {
        "use strict";
        var r, i = this && this.__extends || (r = function(e, t) {
            return (r = Object.setPrototypeOf || {
                    __proto__: []
                }
                instanceof Array && function(e, t) {
                    e.__proto__ = t
                } || function(e, t) {
                    for (var n in t) t.hasOwnProperty(n) && (e[n] = t[n])
                })(e, t)
        }, function(e, t) {
            function n() {
                this.constructor = e
            }
            r(e, t), e.prototype = null === t ? Object.create(t) : (n.prototype = t.prototype, new n)
        });
        Object.defineProperty(t, "__esModule", {
            value: !0
        });
        var a = n(4),
            o = n(5),
            s = n(0),
            u = n(2),
            d = n(8),
            l = n(1),
            c = n(24),
            p = n(25),
            h = function(e) {
                function t(t, n, r, i) {
                    var a = e.call(this) || this;
                    if (a.view = t, a.url = n, a.parameters = r, a.onLicenseRequestPreparation = i, a.player = null, a.tracks = new p.ShakaMediaTracks, a.errorListener = function(e, t) {
                            void 0 === t && (t = "");
                            var n = e.detail ? e.detail : e;
                            a.onError(n, a.compileErrorMsg(n))
                        }, a.onMetadataLoaded = function(e) {
                            if (a.volume = e.target.volume, a.duration = 1e3 * e.target.duration, a.tracks.text = a.player.getTextTracks(), a.textTracks = a.formatTracks(a.tracks.text, function(e) {
                                    return a.findAxTrackType(e)
                                }), a.parameters.selectedTextTrack = null !== a.parameters.selectedTextTrack ? a.parameters.selectedTextTrack : a.parameters.selectedSubtitleTrack, a.parameters.selectedTextLanguage = null !== a.parameters.selectedTextLanguage ? a.parameters.selectedTextLanguage : a.parameters.selectedSubtitleLanguage, null !== a.parameters.selectedTextTrack) a.parameters.selectedTextTrack < a.tracks.text.length && a.setTextTrack(a.parameters.selectedTextTrack);
                            else if (a.parameters.selectedTextLanguage) {
                                var t = a.textTracks.findIndex(function(e) {
                                    return e.languageCode === a.parameters.selectedTextLanguage.toLowerCase()
                                });
                                t > -1 && a.setTextTrack(t)
                            }
                            a.tracks.audio = a.player.getAudioLanguagesAndRoles(), a.audioTracks = a.formatTracks(a.tracks.audio, function(e) {
                                return a.findAxTrackType(e)
                            });
                            var n = a.player.getVariantTracks().find(function(e) {
                                return e.active
                            });
                            if (n && (a.currentAudioTrack = a.audioTracks.find(function(e) {
                                    return e.languageCode === n.language
                                })), null !== a.parameters.selectedAudioTrack) a.parameters.selectedAudioTrack < a.tracks.audio.length && a.setAudioTrack(a.parameters.selectedAudioTrack);
                            else if (a.parameters.selectedAudioLanguage) {
                                var r = a.audioTracks.findIndex(function(e) {
                                    return e.languageCode === a.parameters.selectedAudioLanguage.toLowerCase()
                                });
                                r > -1 && a.setAudioTrack(r)
                            }
                            a.changePlayerState(s.AxPlayerState.PREPARED), !0 === a.parameters.autoPlay && (a.pausedByUser = !1, a.play())
                        }, a.onBufferingChange = function(e) {
                            l.publish(s.VideoEventName.BufferingStatusChanged, new u.BufferingStatusChangedEvent(e.buffering))
                        }, a.onVideoTrackChange = function(e) {
                            var t = a.getCurrentBitrate();
                            t !== a.previousBitrate && (a.previousBitrate = t, l.publish(s.VideoEventName.BitrateChanged, new u.BitrateChangedEvent(t)))
                        }, a.shakaModule = c, a.shakaModule || (window.shaka ? a.shakaModule = window.shaka : a.onError(null, "Could not find Shaka player!")), l.publish(s.VideoEventName.DebugInfo, new u.DebugInfoEvent("Info", "Initializing Shaka player")), a.shakaModule.polyfill.installAll(), !a.shakaModule.Player.isBrowserSupported) return a.onError(null, "Browser is missing Shaka support!"), a;
                    try {
                        a.videoElement = t, a.player = new a.shakaModule.Player(a.videoElement, null), a.addEventListeners(), a.addBaseEventListeners(), a.setupPlayback()
                    } catch (e) {
                        a.onError(e, "Player setup failed!")
                    }
                    return a
                }
                return i(t, e), t.prototype.destroy = function() {
                    this.removeEventListeners(), this.removeBaseEventListeners(), this.player.destroy(), l.publish(s.VideoEventName.DebugInfo, new u.DebugInfoEvent("Info", "Shaka player destroyed"))
                }, t.prototype.setAudioTrack = function(e) {
                    if (-1 === e) return this.currentAudioTrack = null, l.publish(s.VideoEventName.AudioTrackChanged, new u.AudioChangedEvent(-1)), void l.publish(s.VideoEventName.DebugInfo, new u.DebugInfoEvent("Info", "Audio disabled"));
                    this.player.selectAudioLanguage(this.tracks.audio[e].language, null), this.tracks.audio = this.player.getAudioLanguagesAndRoles();
                    var t = -1,
                        n = this.player.getVariantTracks().find(function(e) {
                            return e.active
                        });
                    n && (t = this.audioTracks.findIndex(function(e) {
                        return e.languageCode === n.language
                    })), (!this.currentAudioTrack || t !== this.currentAudioTrack.index && -1 !== t) && (this.currentAudioTrack = this.audioTracks[t], l.publish(s.VideoEventName.AudioTrackChanged, new u.AudioChangedEvent(this.currentAudioTrack.index)))
                }, t.prototype.setTextTrack = function(e) {
                    if (-1 === e) return this.player.setTextTrackVisibility(!1), this.currentTextTrack = null, l.publish(s.VideoEventName.SubtitlesTrackChanged, new u.SubtitlesChangedEvent(-1)), l.publish(s.VideoEventName.TextTrackChanged, new u.TextChangedEvent(-1)), void l.publish(s.VideoEventName.DebugInfo, new u.DebugInfoEvent("Info", "Subtitles disabled"));
                    this.player.selectTextTrack(this.tracks.text[e]), this.player.setTextTrackVisibility(!0), this.tracks.text = this.player.getTextTracks();
                    var t = this.player.getTextTracks().findIndex(function(e) {
                        return e.active
                    });
                    (!this.currentTextTrack || t !== this.currentTextTrack.index && -1 !== t) && (this.currentTextTrack = this.textTracks[t], l.publish(s.VideoEventName.SubtitlesTrackChanged, new u.SubtitlesChangedEvent(this.currentTextTrack.index)), l.publish(s.VideoEventName.TextTrackChanged, new u.TextChangedEvent(this.currentTextTrack.index)))
                }, t.prototype.getCurrentBitrate = function() {
                    return Math.round(this.player.getStats().streamBandwidth)
                }, t.prototype.isBuffering = function() {
                    return this.player.isBuffering()
                }, t.prototype.compileErrorMsg = function(e) {
                    var t = this.shakaModule.util.Error.Code,
                        n = e.detail ? e.detail.code : e.code;
                    for (var r in t)
                        if (t.hasOwnProperty(r) && t[r] === n) return r;
                    return ""
                }, t.prototype.setupPlayback = function() {
                    var e = this;
                    this.parameters.licenseServers ? (l.publish(s.VideoEventName.DebugInfo, new u.DebugInfoEvent("Info", "Setting up DRM configuration")), this.player.configure({
                        drm: {
                            servers: {
                                "com.widevine.alpha": this.parameters.licenseServers.widevine,
                                "com.microsoft.playready": this.parameters.licenseServers.playready
                            }
                        }
                    }), this.parameters.entitlementToken ? this.player.getNetworkingEngine().registerRequestFilter(function(t, n) {
                        t === e.shakaModule.net.NetworkingEngine.RequestType.LICENSE && (n.headers["X-AxDRM-Message"] = e.parameters.entitlementToken, n = e.onLicenseRequestPreparation({
                            type: o.LicenseRequestTypes.Widevine_PlayReady,
                            request: n
                        }))
                    }) : l.publish(s.VideoEventName.DebugInfo, new u.DebugInfoEvent("Warning", "DRM entitlement token is missing!"))) : l.publish(s.VideoEventName.DebugInfo, new u.DebugInfoEvent("Info", "No license servers provided, assuming unprotected asset")), this.parameters.minimumBitrate >= this.parameters.maximumBitrate ? l.publish(s.VideoEventName.DebugInfo, new u.DebugInfoEvent("Warning", "Maximum bitrate cannot be smaller than minimum bitrate")) : this.player.configure({
                        restrictions: {
                            maxBandwidth: this.parameters.maximumBitrate,
                            minBandwidth: this.parameters.minimumBitrate
                        }
                    }), isNaN(this.parameters.startPosition) && (l.publish(s.VideoEventName.DebugInfo, new u.DebugInfoEvent("Warning", "Start position is expected to be number, using 0 as starting position")), this.parameters.startPosition = 0), this.player.load(this.url, this.parameters.startPosition / 1e3, null).then(function() {
                        e.changePlayerState(s.AxPlayerState.PREPARING)
                    }).catch(function(t) {
                        return e.onError(t, "Manifest loading failed!")
                    })
                }, t.prototype.addEventListeners = function() {
                    this.videoElement.addEventListener("loadedmetadata", this.onMetadataLoaded), this.player.addEventListener("error", this.errorListener), this.player.addEventListener("buffering", this.onBufferingChange), this.player.addEventListener("adaptation", this.onVideoTrackChange)
                }, t.prototype.removeEventListeners = function() {
                    this.videoElement.removeEventListener("loadedmetadata", this.onMetadataLoaded), this.player.removeEventListener("error", this.errorListener), this.player.removeEventListener("buffering", this.onBufferingChange), this.player.removeEventListener("adaptation", this.onVideoTrackChange)
                }, t.prototype.findAxTrackType = function(e) {
                    if (e.roles && e.roles[0]) {
                        var t;
                        switch (e.roles[0]) {
                            case "caption":
                                t = a.AxTrackType.Caption;
                                break;
                            case "subtitle":
                                t = a.AxTrackType.Subtitle;
                                break;
                            default:
                                t = a.AxTrackType.Other
                        }
                        return t
                    }
                }, t
            }(d.VideoPlayerBase);
        t.AdaptiveMediaPlayer = h
    }, function(e, t, n) {
        "use strict";
        Object.defineProperty(t, "__esModule", {
            value: !0
        });
        var r = function() {
            return function(e) {
                this.index = e
            }
        }();
        t.AudioChangedEvent = r
    }, function(e, t, n) {
        "use strict";
        Object.defineProperty(t, "__esModule", {
            value: !0
        });
        var r = function() {
            return function(e) {
                this.error = e
            }
        }();
        t.ErrorEvent = r
    }, function(e, t, n) {
        "use strict";
        Object.defineProperty(t, "__esModule", {
            value: !0
        });
        var r = function() {
            return function(e, t) {
                this.from = e, this.to = t
            }
        }();
        t.SeekedEvent = r
    }, function(e, t, n) {
        "use strict";
        Object.defineProperty(t, "__esModule", {
            value: !0
        });
        var r = function() {
            return function(e, t) {
                this.state = e, this.initiator = t
            }
        }();
        t.StateChangedEvent = r
    }, function(e, t, n) {
        "use strict";
        Object.defineProperty(t, "__esModule", {
            value: !0
        });
        var r = function() {
            return function(e) {
                this.bitrate = e
            }
        }();
        t.BitrateChangedEvent = r
    }, function(e, t, n) {
        "use strict";
        Object.defineProperty(t, "__esModule", {
            value: !0
        });
        var r = function() {
            return function(e) {
                this.buffering = e
            }
        }();
        t.BufferingStatusChangedEvent = r
    }, function(e, t, n) {
        "use strict";
        Object.defineProperty(t, "__esModule", {
            value: !0
        });
        var r = function() {
            return function(e) {
                this.index = e
            }
        }();
        t.TextChangedEvent = r
    }, function(e, t, n) {
        "use strict";
        Object.defineProperty(t, "__esModule", {
            value: !0
        });
        var r = function() {
            return function(e) {
                this.index = e
            }
        }();
        t.SubtitlesChangedEvent = r
    }, function(e, t, n) {
        "use strict";
        Object.defineProperty(t, "__esModule", {
            value: !0
        });
        var r = function() {
            return function(e) {
                this.volume = e
            }
        }();
        t.VolumeChangedEvent = r
    }, function(e, t, n) {
        "use strict";
        Object.defineProperty(t, "__esModule", {
            value: !0
        });
        var r = function() {
            return function(e, t) {
                this.tag = e, this.message = t
            }
        }();
        t.DebugInfoEvent = r
    }, function(t, n) {
        t.exports = e
    }, function(e, t, n) {
        "use strict";
        Object.defineProperty(t, "__esModule", {
            value: !0
        });
        var r = function() {
            return function() {
                this.text = [], this.audio = [], this.video = []
            }
        }();
        t.ShakaMediaTracks = r
    }, function(e, t, n) {
        "use strict";
        var r, i = this && this.__extends || (r = function(e, t) {
            return (r = Object.setPrototypeOf || {
                    __proto__: []
                }
                instanceof Array && function(e, t) {
                    e.__proto__ = t
                } || function(e, t) {
                    for (var n in t) t.hasOwnProperty(n) && (e[n] = t[n])
                })(e, t)
        }, function(e, t) {
            function n() {
                this.constructor = e
            }
            r(e, t), e.prototype = null === t ? Object.create(t) : (n.prototype = t.prototype, new n)
        });
        Object.defineProperty(t, "__esModule", {
            value: !0
        });
        var a = n(3),
            o = n(4),
            s = n(0),
            u = n(1),
            d = n(2),
            l = n(8),
            c = n(27),
            p = n(28),
            h = function(e) {
                function t(t, n, r, i) {
                    var o = e.call(this) || this;
                    return o.view = t, o.url = n, o.parameters = r, o.onLicenseRequestPreparation = i, o.tracks = new p.WebMediaTracks, o.closedCaptionNameTag = " [CC]", o.onMetadataLoaded = function(e) {
                        if (o.volume = e.target.volume, o.duration = 1e3 * e.target.duration, o.videoElement.textTracks) {
                            var t = new Event("onSubtitleReady");
                            o.videoElement.textTracks.addEventListener("addtrack", function(e) {
                                e.track && o.videoElement.dispatchEvent(t)
                            })
                        }
                        o.videoElement.audioTracks && o.videoElement.audioTracks.addEventListener("addtrack", function() {
                            o.tracks.audio = o.videoElement.audioTracks, o.audioTracks = o.formatTracks(o.tracks.audio, function(e) {
                                return o.findAxTrackType(e)
                            });
                            for (var e = 0, t = o.tracks.audio.length; e < t; e++) o.tracks.audio[e].enabled && (o.currentAudioTrack = o.audioTracks[e]);
                            if (null !== o.parameters.selectedAudioTrack) o.parameters.selectedAudioTrack < o.tracks.audio.length && o.setAudioTrack(o.parameters.selectedAudioTrack);
                            else if (o.parameters.selectedAudioLanguage) {
                                var n = o.audioTracks.findIndex(function(e) {
                                    return e.languageCode === o.parameters.selectedAudioLanguage.toLowerCase()
                                });
                                n > -1 && o.setAudioTrack(n)
                            }
                        }), o.changePlayerState(s.AxPlayerState.PREPARED), !0 === o.parameters.autoPlay && (o.pausedByUser = !1, o.play())
                    }, o.onTextReady = function() {
                        o.tracks.text = o.videoElement.textTracks, o.textTracks = o.formatTracks(o.tracks.text, function(e) {
                            return o.findAxTrackType(e)
                        });
                        for (var e = 0, t = o.tracks.text.length; e < t; e++) "showing" === o.tracks.text[e].mode && (o.currentTextTrack = o.textTracks[e]);
                        if (o.parameters.selectedTextTrack = null !== o.parameters.selectedTextTrack ? o.parameters.selectedTextTrack : o.parameters.selectedSubtitleTrack, o.parameters.selectedTextLanguage = null !== o.parameters.selectedTextLanguage ? o.parameters.selectedTextLanguage : o.parameters.selectedSubtitleLanguage, null !== o.parameters.selectedTextTrack) o.parameters.selectedTextTrack < o.tracks.text.length && o.setTextTrack(o.parameters.selectedTextTrack);
                        else if (o.parameters.selectedTextLanguage) {
                            var n = o.textTracks.findIndex(function(e) {
                                return e.languageCode === o.parameters.selectedTextLanguage.toLowerCase()
                            });
                            n > -1 && o.setTextTrack(n)
                        }
                        o.videoElement.removeEventListener("onSubtitleReady", o.onTextReady)
                    }, o.onBufferingStarted = function(e) {
                        u.publish(s.VideoEventName.BufferingStatusChanged, new d.BufferingStatusChangedEvent(!0))
                    }, o.onBufferingEnded = function(e) {
                        u.publish(s.VideoEventName.BufferingStatusChanged, new d.BufferingStatusChangedEvent(!1))
                    }, o.onNeedKey = function(e) {
                        u.publish(s.VideoEventName.DebugInfo, new d.DebugInfoEvent("Info", "DRM-protected video, trying to set up FairPlay...")), o.parameters.licenseServers && o.parameters.licenseServers.fairplay || o.onError(new a.AxPlayerError("", "DRM: Playback failed - FairPlay license server missing in parameters!")), o.parameters.entitlementToken || o.onError(new a.AxPlayerError("", "DRM: Playback failed - entitlement token missing in parameters!")), o.parameters.fpsCertificateUrl || o.onError(new a.AxPlayerError("", "DRM: Playback failed - FairPlay certificate URL missing in parameters!")), e.initData || o.onError(new a.AxPlayerError("", "DRM: Playback failed - initialization data missing in 'needkey' event!")), u.publish(s.VideoEventName.DebugInfo, new d.DebugInfoEvent("DRM", "Creating key manager")), o.keyManager = new c.FairPlayManager(o.parameters, e.initData, o.videoElement, o.onLicenseRequestPreparation)
                    }, u.publish(s.VideoEventName.DebugInfo, new d.DebugInfoEvent("Info", "Initializing HTML5 player")), o.videoElement = t, o.addEventListeners(), o.addBaseEventListeners(), o.setupPlayback(), o
                }
                return i(t, e), t.prototype.destroy = function() {
                    this.videoElement.src = "", this.removeEventListeners(), this.removeBaseEventListeners(), u.publish(s.VideoEventName.DebugInfo, new d.DebugInfoEvent("Info", "HTML5 player destroyed"))
                }, t.prototype.setAudioTrack = function(e) {
                    if (-1 === e) return this.currentAudioTrack = null, u.publish(s.VideoEventName.AudioTrackChanged, new d.AudioChangedEvent(-1)), void u.publish(s.VideoEventName.DebugInfo, new d.DebugInfoEvent("Info", "Audio disabled"));
                    for (var t = -1, n = 0, r = this.tracks.audio.length; n < r; n++) n === e ? (this.tracks.audio[n].enabled = !0, t = n) : this.tracks.audio[n].enabled && (this.tracks.audio[n].enabled = !1);
                    (!this.currentAudioTrack || this.currentAudioTrack.index !== t && -1 !== t) && (this.currentAudioTrack = this.audioTracks[t], u.publish(s.VideoEventName.AudioTrackChanged, new d.AudioChangedEvent(this.currentAudioTrack.index)))
                }, t.prototype.setTextTrack = function(e) {
                    if (-1 === e) {
                        for (var t = 0, n = this.tracks.text.length; t < n; t++) this.tracks.text[t].mode = "hidden";
                        return this.currentTextTrack = null, u.publish(s.VideoEventName.SubtitlesTrackChanged, new d.SubtitlesChangedEvent(-1)), u.publish(s.VideoEventName.TextTrackChanged, new d.TextChangedEvent(-1)), void u.publish(s.VideoEventName.DebugInfo, new d.DebugInfoEvent("Info", "Text tracks disabled"))
                    }
                    var r = -1;
                    for (t = 0, n = this.tracks.text.length; t < n; t++) t === e ? (this.tracks.text[t].mode = "showing", r = t) : "showing" === this.tracks.text[t].mode && (this.tracks.text[t].mode = "hidden");
                    (!this.currentTextTrack || this.currentTextTrack.index !== r && -1 !== r) && (this.currentTextTrack = this.textTracks[r], this.currentTextTrack && (u.publish(s.VideoEventName.SubtitlesTrackChanged, new d.SubtitlesChangedEvent(this.currentTextTrack.index)), u.publish(s.VideoEventName.TextTrackChanged, new d.TextChangedEvent(this.currentTextTrack.index))))
                }, t.prototype.getCurrentBitrate = function() {
                    return 0
                }, t.prototype.isBuffering = function() {
                    return this.videoElement.readyState < this.videoElement.HAVE_FUTURE_DATA
                }, t.prototype.setupPlayback = function() {
                    isNaN(this.parameters.startPosition) && (u.publish(s.VideoEventName.DebugInfo, new d.DebugInfoEvent("Warning", "Start position is expected to be number, using 0 as starting position")), this.parameters.startPosition = 0), this.videoElement.src = this.url, this.videoElement.currentTime = this.parameters.startPosition / 1e3, this.changePlayerState(s.AxPlayerState.PREPARING)
                }, t.prototype.addEventListeners = function() {
                    this.videoElement.addEventListener("loadedmetadata", this.onMetadataLoaded), this.videoElement.addEventListener("waiting", this.onBufferingStarted), this.videoElement.addEventListener("canplay", this.onBufferingEnded), this.videoElement.addEventListener("webkitneedkey", this.onNeedKey), this.videoElement.addEventListener("needkey", this.onNeedKey), this.videoElement.addEventListener("onSubtitleReady", this.onTextReady)
                }, t.prototype.removeEventListeners = function() {
                    this.videoElement.removeEventListener("loadedmetadata", this.onMetadataLoaded), this.videoElement.removeEventListener("waiting", this.onBufferingStarted), this.videoElement.removeEventListener("canplay", this.onBufferingEnded), this.videoElement.removeEventListener("webkitneedkey", this.onNeedKey), this.videoElement.removeEventListener("needkey", this.onNeedKey)
                }, t.prototype.findAxTrackType = function(e) {
                    var t;
                    if (e.kind) {
                        var n;
                        switch (t = e.kind, e.label.endsWith(this.closedCaptionNameTag) && (t = "caption"), t) {
                            case "caption":
                                n = o.AxTrackType.Caption;
                                break;
                            case "subtitles":
                                n = o.AxTrackType.Subtitle;
                                break;
                            default:
                                n = o.AxTrackType.Other
                        }
                        return n
                    }
                }, t
            }(l.VideoPlayerBase);
        t.WebVideoPlayer = h
    }, function(e, t, n) {
        "use strict";
        Object.defineProperty(t, "__esModule", {
            value: !0
        });
        var r = n(3),
            i = n(5),
            a = n(1),
            o = n(2),
            s = n(6),
            u = function() {
                function e(e, t, n, r) {
                    var u = this;
                    this.onLicenseRequestPreparation = r, this.certificate = null, this.initializeKey = function() {
                        if (u.certificate) {
                            var e = u.extractContentId(u.initData);
                            u.initData = u.concatInitDataIdAndCertificate(u.initData, e, u.certificate), u.videoElement.webkitKeys ? a.publish(s.VideoEventName.DebugInfo, new o.DebugInfoEvent("DRM", "FairPlay key system is present")) : (u.selectKeySystem(), u.videoElement.webkitSetMediaKeys(new WebKitMediaKeys(u.keySystem))), u.videoElement.webkitKeys || u.reportError("DRM: Could not create MediaKeys");
                            var t = u.videoElement.webkitKeys.createSession("video/mp4", u.initData);
                            t ? t.contentId = e : u.reportError("DRM: Could not create key session"), a.publish(s.VideoEventName.DebugInfo, new o.DebugInfoEvent("DRM", "Key session created!")), u.waitForEvent("webkitkeymessage", u.licenseRequestReady, t), u.waitForEvent("webkitkeyadded", u.onkeyadded, t), u.waitForEvent("webkitkeyerror", u.onkeyerror, t)
                        } else u.reportError("DRM: Certificate not loaded, cannot initialize key session.")
                    }, this.licenseRequestReady = function(e) {
                        var t = e.target,
                            n = e.message,
                            r = new XMLHttpRequest;
                        r.responseType = "arraybuffer", r.session = t, r.addEventListener("error", u.licenseRequestFailed, !1), r.open("POST", u.licenseServerUrl, !0), r.setRequestHeader("Content-type", "application/octet-stream"), r.setRequestHeader("X-AxDRM-Message", u.entitlementToken);
                        var d = !0;
                        u.onLicenseRequestPreparation({
                            type: i.LicenseRequestTypes.FairPlay,
                            request: r
                        }) && "text" === r.responseType && (d = !1), r.addEventListener("load", u.licenseRequestLoaded.bind(u, d), !1), r.send(n), a.publish(s.VideoEventName.DebugInfo, new o.DebugInfoEvent("DRM", "License request created and posted to license server"))
                    }, this.onkeyerror = function(e) {
                        u.reportError("DRM: A decryption key error was encountered")
                    }, this.onkeyadded = function(e) {
                        a.publish(s.VideoEventName.DebugInfo, new o.DebugInfoEvent("DRM", "Decryption key successfully added to key session."))
                    }, this.licenseRequestLoaded = function(e, t) {
                        var n = t.target;
                        if (200 === n.status) {
                            a.publish(s.VideoEventName.DebugInfo, new o.DebugInfoEvent("DRM", "License response received successfully."));
                            var r = n.session;
                            if (r) {
                                var i = e ? function(e) {
                                    var t = e.response;
                                    return new Uint8Array(t)
                                } : function(e) {
                                    for (var t = atob(e.response), n = t.length, r = new Uint8Array(new ArrayBuffer(n)), i = 0; i < n; i++) r[i] = t.charCodeAt(i);
                                    return r
                                };
                                r.update(i(n))
                            } else u.reportError("DRM: The license request failed, no session.")
                        } else u.reportError('DRM: The license request returned "' + n.statusText + '"')
                    }, this.licenseRequestFailed = function(e) {
                        u.reportError("DRM: The license request failed.")
                    }, this.onCertificateLoaded = function(e) {
                        a.publish(s.VideoEventName.DebugInfo, new o.DebugInfoEvent("DRM", "FairPlay certificate loaded"));
                        var t = e.target;
                        u.certificate = new Uint8Array(t.response), a.publish(s.VideoEventName.DebugInfo, new o.DebugInfoEvent("DRM", "Trying to initialize key session")), u.initializeKey()
                    }, this.onCertificateError = function(e) {
                        u.reportError("DRM: Failed to retrieve FairPlay certificate.")
                    };
                    try {
                        this.licenseServerUrl = e.licenseServers.fairplay, this.entitlementToken = e.entitlementToken, this.applicationCertificatePath = e.fpsCertificateUrl, this.initData = t, this.videoElement = n, this.loadCertificate()
                    } catch (e) {
                        this.reportError("DRM: Failed to create key manager", e)
                    }
                }
                return e.prototype.loadCertificate = function() {
                    a.publish(s.VideoEventName.DebugInfo, new o.DebugInfoEvent("DRM", "Attempting to load FairPlay certificate"));
                    var e = new XMLHttpRequest;
                    e.responseType = "arraybuffer", e.addEventListener("load", this.onCertificateLoaded, !1), e.addEventListener("error", this.onCertificateError, !1), e.open("GET", this.applicationCertificatePath, !0), e.setRequestHeader("Pragma", "Cache-Control: no-cache"), e.setRequestHeader("Cache-Control", "max-age=0"), e.send()
                }, e.prototype.selectKeySystem = function() {
                    WebKitMediaKeys.isTypeSupported("com.apple.fps.1_0", "video/mp4") ? (a.publish(s.VideoEventName.DebugInfo, new o.DebugInfoEvent("DRM", "FairPlay key system selected")), this.keySystem = "com.apple.fps.1_0") : this.reportError("DRM: FairPlay key system not supported!")
                }, e.prototype.concatInitDataIdAndCertificate = function(e, t, n) {
                    "string" == typeof t && (t = this.stringToArray(t));
                    var r = 0,
                        i = new ArrayBuffer(e.byteLength + 4 + t.byteLength + 4 + n.byteLength),
                        a = new DataView(i);
                    new Uint8Array(i, r, e.byteLength).set(e), r += e.byteLength, a.setUint32(r, t.byteLength, !0), r += 4;
                    var o = new Uint16Array(i, r, t.length);
                    return o.set(t), r += o.byteLength, a.setUint32(r, n.byteLength, !0), r += 4, new Uint8Array(i, r, n.byteLength).set(n), new Uint8Array(i, 0, i.byteLength)
                }, e.prototype.extractContentId = function(e) {
                    return this.arrayToString(e).replace(/^.*:\/\//, "")
                }, e.prototype.waitForEvent = function(e, t, n) {
                    n.addEventListener(e, function() {
                        t(arguments[0])
                    }, !1)
                }, e.prototype.arrayToString = function(e) {
                    var t = new Uint16Array(e.buffer);
                    return String.fromCharCode.apply(null, t)
                }, e.prototype.stringToArray = function(e) {
                    for (var t = new ArrayBuffer(2 * e.length), n = new Uint16Array(t), r = 0, i = e.length; r < i; r++) n[r] = e.charCodeAt(r);
                    return n
                }, e.prototype.reportError = function(e, t) {
                    throw void 0 === t && (t = null), t || (t = new Error(e)), a.publish(s.VideoEventName.Error, new o.ErrorEvent(new r.AxPlayerError("", e, t))), t
                }, e
            }();
        t.FairPlayManager = u
    }, function(e, t, n) {
        "use strict";
        Object.defineProperty(t, "__esModule", {
            value: !0
        });
        var r = function() {
            return function() {}
        }();
        t.WebMediaTracks = r
    }])
});