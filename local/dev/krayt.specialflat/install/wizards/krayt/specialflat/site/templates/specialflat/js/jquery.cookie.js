!function(e){"function"==typeof define&&define.amd?define(["jquery"],e):"object"==typeof exports?module.exports=e(require("jquery")):e(jQuery)}(function(l){var i=/\+/g;function m(e){return g.raw?e:encodeURIComponent(e)}function x(e,n){var o=g.raw?e:function(e){0===e.indexOf('"')&&(e=e.slice(1,-1).replace(/\\"/g,'"').replace(/\\\\/g,"\\"));try{return e=decodeURIComponent(e.replace(i," ")),g.json?JSON.parse(e):e}catch(e){}}(e);return l.isFunction(n)?n(o):o}var g=l.cookie=function(e,n,o){if(1<arguments.length&&!l.isFunction(n)){if("number"==typeof(o=l.extend({},g.defaults,o)).expires){var i=o.expires,r=o.expires=new Date;r.setMilliseconds(r.getMilliseconds()+864e5*i)}return document.cookie=[m(e),"=",function(e){return m(g.json?JSON.stringify(e):String(e))}(n),o.expires?"; expires="+o.expires.toUTCString():"",o.path?"; path="+o.path:"",o.domain?"; domain="+o.domain:"",o.secure?"; secure":""].join("")}for(var t,c=e?void 0:{},u=document.cookie?document.cookie.split("; "):[],s=0,a=u.length;s<a;s++){var d=u[s].split("="),f=(t=d.shift(),g.raw?t:decodeURIComponent(t)),p=d.join("=");if(e===f){c=x(p,n);break}e||void 0===(p=x(p))||(c[f]=p)}return c};g.defaults={},l.removeCookie=function(e,n){return l.cookie(e,"",l.extend({},n,{expires:-1})),!l.cookie(e)}});