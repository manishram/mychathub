<?php
if (session_status() == PHP_SESSION_NONE) {session_start();}
if(!isset($_SESSION['username']) && (!isset($_COOKIE['cookie_username']) && !isset($_COOKIE['cookie_session_id']))){die(header('location: signin.php'));}


include"include/app-data.php";

include"conn.php";

if(!(isset($_SESSION['username'])) && (!isset($_COOKIE['cookie_username']) && !isset($_COOKIE['cookie_session_id']))){header("Location: index.php");
die();}
else{
if(isset($_SESSION['username']))
{
$username=$_SESSION['username'];
$sql = "SELECT*from users where username='$username' ";
$query=mysqli_query($conn,$sql);
$row = mysqli_fetch_array($query);
$count=mysqli_num_rows($query);
if($count==0){die(header("Location: logout.php"));}
}
elseif(isset($_COOKIE['cookie_username']) && isset($_COOKIE['cookie_session_id']))
{	
$sql = "SELECT*from users where username='$_COOKIE[cookie_username]' AND session_id='$_COOKIE[cookie_session_id]' ";
$query=mysqli_query($conn,$sql);
$row = mysqli_fetch_array($query);
$count=mysqli_num_rows($query);
if($count==0){die(header("Location: logout.php"));}	
else{
$username=$_COOKIE['cookie_username'];
$_SESSION['username']=$_COOKIE['cookie_username'];}
}else{die(header("Location: logout.php"));}	
}

include('include/guest-username-modify.php');
?>
<!DOCTYPE html>
<html lang="en">
<head style=''>
  <meta charset="utf-8" />
  <title>MyChatHub | Chat Room</title>
  <meta name="viewport" content= "width=device-width, user-scalable=no">
  <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=device-dpi" />
  <meta name="viewport" content="width=device-width, height=device-height">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="theme-color" content="#0cc2aa">
  <!-- for ios 7 style, multi-resolution icon of 152x152 -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
  <link rel="apple-touch-icon" href="../assets/images/logo.png">
  <meta name="apple-mobile-web-app-title" content="">
  <!-- for Chrome on Android, multi-resolution icon of 196x196 -->
  <meta name="mobile-web-app-capable" content="yes">
  <link rel="shortcut icon" sizes="196x196" href="../assets/images/logo.png">
  
  <!-- style -->
  <link rel="stylesheet" href="../assets/animate.css/animate.min.css" type="text/css" />
  <link rel="stylesheet" href="../assets/glyphicons/glyphicons.css" type="text/css" />
  <link rel='stylesheet' href='../assets/styles/all.css' type='text/css' >
  <link rel="stylesheet" href="../assets/material-design-icons/material-design-icons.css" type="text/css" />

  <link rel="stylesheet" href="../assets/bootstrap/dist/css/bootstrap.min.css" type="text/css" />
  <!-- build:css ../assets/styles/app.min.css -->
  <link rel="stylesheet" href="../assets/styles/app.css" type="text/css" />
  <!-- endbuild -->
  <link rel="stylesheet" href="../assets/styles/font.css" type="text/css" />

  <script src="../libs/jquery/jquery/dist/jquery.js"></script>  
  <link rel="stylesheet" href="../assets/styles/style.css" type="text/css" />
   <style>
/* Compose */

.conversation-compose {
  display: flex;
  flex-direction: row;
  align-items: flex-end;
  overflow: hidden;
  height: 40px;
  width: 100%;
  z-index: 2;
}

.conversation-compose div,
.conversation-compose input {
  background: #fff;
  height: 100%;
}

.conversation-compose .emoji {
  display: flex;
  align-items: center;
  justify-content: center;
  background: white;
  border-radius: 50% 0 0 50%;
  flex: 0 0 auto;
  margin-left: 8px;
  width: 38px;
  height: 38px;
}

.conversation-compose .input-msg {
  border: 0;
  flex: 1 1 auto;
  font-size: 14px;
  margin: 0;
  outline: none;
  min-width: 50px;
  height: 36px;
}

.conversation-compose .photo {
  flex: 0 0 auto;
  border-radius: 0 30px 30px 0;
  text-align: center;
  width: auto;
  display: flex;
  padding-right: 6px;
  height: 38px;
}

.conversation-compose .photo img {
  display: block;
  color: #7d8488;
  font-size: 24px;
  transform: translate(-50%, -50%);
  position: relative;
  top: 50%;
  margin-left: 10px;
}


.conversation-compose .send {
  background: transparent;
  border: 0;
  cursor: pointer;
  flex: 0 0 auto;
  margin-right: 8px;
  padding: 0;
  position: relative;
  outline: none;
  margin-left: .5rem;
}

.conversation-compose .send .circle {
  background: #0cc2aa;
  border-radius: 50%;
  color: #fff;
  position: relative;
  width: 38px;
  height: 38px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.conversation-compose .send .circle i {
  font-size: 24px;
  margin-left: 1px;
}

/* Small Screens */



@media (min-width: 575px){

#msg-input-div-2{
	display:none !important;
}	
}
.image-cropper {
	border:2px solid white;
	background:white;
	display:block;
    width: 100px;
    height: 100px;
    position: relative;
    overflow: hidden;
	
    border-radius: 50%;
}
.profile-pic {
	
  display: inline;
  margin-left: 0px;

  height: 100px;
  width: auto;
}
</style> 
<script>
// Saves the messaging device token to the datastore.
function saveMessagingDeviceToken() {
  firebase.messaging().getToken().then(function(currentToken) {
    if (currentToken) {
      console.log('Got FCM device token:', currentToken);
      // Saving the Device Token to the datastore.
      firebase.firestore().collection('fcmTokens').doc(currentToken)
          .set({uid: firebase.auth().currentUser.uid});
    } else {
      // Need to request permissions to show notifications.
      // Requests permission to show notifications.
function requestNotificationsPermissions() {
  console.log('Requesting notifications permission...');
  firebase.messaging().requestPermission().then(function() {
    // Notification permission granted.
    saveMessagingDeviceToken();
  }).catch(function(error) {
    console.error('Unable to get permission to notify.', error);
  });
}
    }
  }).catch(function(error){
    console.error('Unable to get messaging token.', error);
  });
}
</script>

  <link rel="icon" sizes="128x128" href="../images/touch/icon-128x128.png">
<link rel="apple-touch-icon" sizes="128x128" href="../images/touch/icon-128x128.png">
<link rel="icon" sizes="192x192" href="icon-192x192.png">
<link rel="apple-touch-icon" sizes="192x192" href="../images/touch/icon-192x192.png">
<link rel="icon" sizes="256x256" href="../images/touch/icon-256x256.png">
<link rel="apple-touch-icon" sizes="256x256" href="../images/touch/icon-256x256.png">
<link rel="icon" sizes="384x384" href="../images/touch/icon-384x384.png">
<link rel="apple-touch-icon" sizes="384x384" href="../images/touch/icon-384x384.png">
<link rel="icon" sizes="512x512" href="../images/touch/icon-512x512.png">
<link rel="apple-touch-icon" sizes="512x512" href="../images/touch/icon-512x512.png">
  <link rel='manifest' href='../manifest.json'>
  <script type="module">
  /**
 * Skipped minification because the original files appears to be already minified.
 * Do NOT use SRI with dynamically generated files! More information: https://www.jsdelivr.com/using-sri-with-dynamic-files
 */
/**
 * @license
 * Copyright (c) 2017 The Polymer Project Authors. All rights reserved.
 * This code may only be used under the BSD style license found at
 * http://polymer.github.io/LICENSE.txt
 * The complete set of authors may be found at
 * http://polymer.github.io/AUTHORS.txt
 * The complete set of contributors may be found at
 * http://polymer.github.io/CONTRIBUTORS.txt
 * Code distributed by Google as part of the polymer project is also
 * subject to an additional IP rights grant found at
 * http://polymer.github.io/PATENTS.txt
 */
const t=new WeakMap,e=e=>"function"==typeof e&&t.has(e),s=void 0!==window.customElements&&void 0!==window.customElements.polyfillWrapFlushCallback,i=(t,e,s=null)=>{for(;e!==s;){const s=e.nextSibling;t.removeChild(e),e=s}},n={},o={},r=`{{lit-${String(Math.random()).slice(2)}}}`,a=`\x3c!--${r}--\x3e`,l=new RegExp(`${r}|${a}`);class h{constructor(t,e){this.parts=[],this.element=e;const s=[],i=[],n=document.createTreeWalker(e.content,133,null,!1);let o=0,a=-1,h=0;const{strings:c,values:{length:f}}=t;for(;h<f;){const t=n.nextNode();if(null!==t){if(a++,1===t.nodeType){if(t.hasAttributes()){const e=t.attributes,{length:s}=e;let i=0;for(let t=0;t<s;t++)d(e[t].name,"$lit$")&&i++;for(;i-- >0;){const e=c[h],s=u.exec(e)[2],i=s.toLowerCase()+"$lit$",n=t.getAttribute(i);t.removeAttribute(i);const o=n.split(l);this.parts.push({type:"attribute",index:a,name:s,strings:o}),h+=o.length-1}}"TEMPLATE"===t.tagName&&(i.push(t),n.currentNode=t.content)}else if(3===t.nodeType){const e=t.data;if(e.indexOf(r)>=0){const i=t.parentNode,n=e.split(l),o=n.length-1;for(let e=0;e<o;e++){let s,o=n[e];if(""===o)s=p();else{const t=u.exec(o);null!==t&&d(t[2],"$lit$")&&(o=o.slice(0,t.index)+t[1]+t[2].slice(0,-"$lit$".length)+t[3]),s=document.createTextNode(o)}i.insertBefore(s,t),this.parts.push({type:"node",index:++a})}""===n[o]?(i.insertBefore(p(),t),s.push(t)):t.data=n[o],h+=o}}else if(8===t.nodeType)if(t.data===r){const e=t.parentNode;null!==t.previousSibling&&a!==o||(a++,e.insertBefore(p(),t)),o=a,this.parts.push({type:"node",index:a}),null===t.nextSibling?t.data="":(s.push(t),a--),h++}else{let e=-1;for(;-1!==(e=t.data.indexOf(r,e+1));)this.parts.push({type:"node",index:-1}),h++}}else n.currentNode=i.pop()}for(const t of s)t.parentNode.removeChild(t)}}const d=(t,e)=>{const s=t.length-e.length;return s>=0&&t.slice(s)===e},c=t=>-1!==t.index,p=()=>document.createComment(""),u=/([ \x09\x0a\x0c\x0d])([^\0-\x1F\x7F-\x9F "'>=/]+)([ \x09\x0a\x0c\x0d]*=[ \x09\x0a\x0c\x0d]*(?:[^ \x09\x0a\x0c\x0d"'`<>=]*|"[^"]*|'[^']*))$/;
/**
 * @license
 * Copyright (c) 2017 The Polymer Project Authors. All rights reserved.
 * This code may only be used under the BSD style license found at
 * http://polymer.github.io/LICENSE.txt
 * The complete set of authors may be found at
 * http://polymer.github.io/AUTHORS.txt
 * The complete set of contributors may be found at
 * http://polymer.github.io/CONTRIBUTORS.txt
 * Code distributed by Google as part of the polymer project is also
 * subject to an additional IP rights grant found at
 * http://polymer.github.io/PATENTS.txt
 */
class f{constructor(t,e,s){this.__parts=[],this.template=t,this.processor=e,this.options=s}update(t){let e=0;for(const s of this.__parts)void 0!==s&&s.setValue(t[e]),e++;for(const t of this.__parts)void 0!==t&&t.commit()}_clone(){const t=s?this.template.element.content.cloneNode(!0):document.importNode(this.template.element.content,!0),e=[],i=this.template.parts,n=document.createTreeWalker(t,133,null,!1);let o,r=0,a=0,l=n.nextNode();for(;r<i.length;)if(o=i[r],c(o)){for(;a<o.index;)a++,"TEMPLATE"===l.nodeName&&(e.push(l),n.currentNode=l.content),null===(l=n.nextNode())&&(n.currentNode=e.pop(),l=n.nextNode());if("node"===o.type){const t=this.processor.handleTextExpression(this.options);t.insertAfterNode(l.previousSibling),this.__parts.push(t)}else this.__parts.push(...this.processor.handleAttributeExpressions(l,o.name,o.strings,this.options));r++}else this.__parts.push(void 0),r++;return s&&(document.adoptNode(t),customElements.upgrade(t)),t}}
/**
 * @license
 * Copyright (c) 2017 The Polymer Project Authors. All rights reserved.
 * This code may only be used under the BSD style license found at
 * http://polymer.github.io/LICENSE.txt
 * The complete set of authors may be found at
 * http://polymer.github.io/AUTHORS.txt
 * The complete set of contributors may be found at
 * http://polymer.github.io/CONTRIBUTORS.txt
 * Code distributed by Google as part of the polymer project is also
 * subject to an additional IP rights grant found at
 * http://polymer.github.io/PATENTS.txt
 */const m=` ${r} `;class g{constructor(t,e,s,i){this.strings=t,this.values=e,this.type=s,this.processor=i}getHTML(){const t=this.strings.length-1;let e="",s=!1;for(let i=0;i<t;i++){const t=this.strings[i],n=t.lastIndexOf("\x3c!--");s=(n>-1||s)&&-1===t.indexOf("--\x3e",n+1);const o=u.exec(t);e+=null===o?t+(s?m:a):t.substr(0,o.index)+o[1]+o[2]+"$lit$"+o[3]+r}return e+=this.strings[t],e}getTemplateElement(){const t=document.createElement("template");return t.innerHTML=this.getHTML(),t}}
/**
 * @license
 * Copyright (c) 2017 The Polymer Project Authors. All rights reserved.
 * This code may only be used under the BSD style license found at
 * http://polymer.github.io/LICENSE.txt
 * The complete set of authors may be found at
 * http://polymer.github.io/AUTHORS.txt
 * The complete set of contributors may be found at
 * http://polymer.github.io/CONTRIBUTORS.txt
 * Code distributed by Google as part of the polymer project is also
 * subject to an additional IP rights grant found at
 * http://polymer.github.io/PATENTS.txt
 */const _=t=>null===t||!("object"==typeof t||"function"==typeof t),y=t=>Array.isArray(t)||!(!t||!t[Symbol.iterator]);class v{constructor(t,e,s){this.dirty=!0,this.element=t,this.name=e,this.strings=s,this.parts=[];for(let t=0;t<s.length-1;t++)this.parts[t]=this._createPart()}_createPart(){return new w(this)}_getValue(){const t=this.strings,e=t.length-1;let s="";for(let i=0;i<e;i++){s+=t[i];const e=this.parts[i];if(void 0!==e){const t=e.value;if(_(t)||!y(t))s+="string"==typeof t?t:String(t);else for(const e of t)s+="string"==typeof e?e:String(e)}}return s+=t[e],s}commit(){this.dirty&&(this.dirty=!1,this.element.setAttribute(this.name,this._getValue()))}}class w{constructor(t){this.value=void 0,this.committer=t}setValue(t){t===n||_(t)&&t===this.value||(this.value=t,e(t)||(this.committer.dirty=!0))}commit(){for(;e(this.value);){const t=this.value;this.value=n,t(this)}this.value!==n&&this.committer.commit()}}class S{constructor(t){this.value=void 0,this.__pendingValue=void 0,this.options=t}appendInto(t){this.startNode=t.appendChild(p()),this.endNode=t.appendChild(p())}insertAfterNode(t){this.startNode=t,this.endNode=t.nextSibling}appendIntoPart(t){t.__insert(this.startNode=p()),t.__insert(this.endNode=p())}insertAfterPart(t){t.__insert(this.startNode=p()),this.endNode=t.endNode,t.endNode=this.startNode}setValue(t){this.__pendingValue=t}commit(){for(;e(this.__pendingValue);){const t=this.__pendingValue;this.__pendingValue=n,t(this)}const t=this.__pendingValue;t!==n&&(_(t)?t!==this.value&&this.__commitText(t):t instanceof g?this.__commitTemplateResult(t):t instanceof Node?this.__commitNode(t):y(t)?this.__commitIterable(t):t===o?(this.value=o,this.clear()):this.__commitText(t))}__insert(t){this.endNode.parentNode.insertBefore(t,this.endNode)}__commitNode(t){this.value!==t&&(this.clear(),this.__insert(t),this.value=t)}__commitText(t){const e=this.startNode.nextSibling,s="string"==typeof(t=null==t?"":t)?t:String(t);e===this.endNode.previousSibling&&3===e.nodeType?e.data=s:this.__commitNode(document.createTextNode(s)),this.value=t}__commitTemplateResult(t){const e=this.options.templateFactory(t);if(this.value instanceof f&&this.value.template===e)this.value.update(t.values);else{const s=new f(e,t.processor,this.options),i=s._clone();s.update(t.values),this.__commitNode(i),this.value=s}}__commitIterable(t){Array.isArray(this.value)||(this.value=[],this.clear());const e=this.value;let s,i=0;for(const n of t)s=e[i],void 0===s&&(s=new S(this.options),e.push(s),0===i?s.appendIntoPart(this):s.insertAfterPart(e[i-1])),s.setValue(n),s.commit(),i++;i<e.length&&(e.length=i,this.clear(s&&s.endNode))}clear(t=this.startNode){i(this.startNode.parentNode,t.nextSibling,this.endNode)}}class b{constructor(t,e,s){if(this.value=void 0,this.__pendingValue=void 0,2!==s.length||""!==s[0]||""!==s[1])throw new Error("Boolean attributes can only contain a single expression");this.element=t,this.name=e,this.strings=s}setValue(t){this.__pendingValue=t}commit(){for(;e(this.__pendingValue);){const t=this.__pendingValue;this.__pendingValue=n,t(this)}if(this.__pendingValue===n)return;const t=!!this.__pendingValue;this.value!==t&&(t?this.element.setAttribute(this.name,""):this.element.removeAttribute(this.name),this.value=t),this.__pendingValue=n}}class x extends v{constructor(t,e,s){super(t,e,s),this.single=2===s.length&&""===s[0]&&""===s[1]}_createPart(){return new P(this)}_getValue(){return this.single?this.parts[0].value:super._getValue()}commit(){this.dirty&&(this.dirty=!1,this.element[this.name]=this._getValue())}}class P extends w{}let C=!1;try{const t={get capture(){return C=!0,!1}};window.addEventListener("test",t,t),window.removeEventListener("test",t,t)}catch(t){}class T{constructor(t,e,s){this.value=void 0,this.__pendingValue=void 0,this.element=t,this.eventName=e,this.eventContext=s,this.__boundHandleEvent=t=>this.handleEvent(t)}setValue(t){this.__pendingValue=t}commit(){for(;e(this.__pendingValue);){const t=this.__pendingValue;this.__pendingValue=n,t(this)}if(this.__pendingValue===n)return;const t=this.__pendingValue,s=this.value,i=null==t||null!=s&&(t.capture!==s.capture||t.once!==s.once||t.passive!==s.passive),o=null!=t&&(null==s||i);i&&this.element.removeEventListener(this.eventName,this.__boundHandleEvent,this.__options),o&&(this.__options=N(t),this.element.addEventListener(this.eventName,this.__boundHandleEvent,this.__options)),this.value=t,this.__pendingValue=n}handleEvent(t){"function"==typeof this.value?this.value.call(this.eventContext||this.element,t):this.value.handleEvent(t)}}const N=t=>t&&(C?{capture:t.capture,passive:t.passive,once:t.once}:t.capture)
/**
 * @license
 * Copyright (c) 2017 The Polymer Project Authors. All rights reserved.
 * This code may only be used under the BSD style license found at
 * http://polymer.github.io/LICENSE.txt
 * The complete set of authors may be found at
 * http://polymer.github.io/AUTHORS.txt
 * The complete set of contributors may be found at
 * http://polymer.github.io/CONTRIBUTORS.txt
 * Code distributed by Google as part of the polymer project is also
 * subject to an additional IP rights grant found at
 * http://polymer.github.io/PATENTS.txt
 */;const E=new class{handleAttributeExpressions(t,e,s,i){const n=e[0];if("."===n){return new x(t,e.slice(1),s).parts}return"@"===n?[new T(t,e.slice(1),i.eventContext)]:"?"===n?[new b(t,e.slice(1),s)]:new v(t,e,s).parts}handleTextExpression(t){return new S(t)}};
/**
 * @license
 * Copyright (c) 2017 The Polymer Project Authors. All rights reserved.
 * This code may only be used under the BSD style license found at
 * http://polymer.github.io/LICENSE.txt
 * The complete set of authors may be found at
 * http://polymer.github.io/AUTHORS.txt
 * The complete set of contributors may be found at
 * http://polymer.github.io/CONTRIBUTORS.txt
 * Code distributed by Google as part of the polymer project is also
 * subject to an additional IP rights grant found at
 * http://polymer.github.io/PATENTS.txt
 */function A(t){let e=k.get(t.type);void 0===e&&(e={stringsArray:new WeakMap,keyString:new Map},k.set(t.type,e));let s=e.stringsArray.get(t.strings);if(void 0!==s)return s;const i=t.strings.join(r);return s=e.keyString.get(i),void 0===s&&(s=new h(t,t.getTemplateElement()),e.keyString.set(i,s)),e.stringsArray.set(t.strings,s),s}const k=new Map,V=new WeakMap;
/**
 * @license
 * Copyright (c) 2017 The Polymer Project Authors. All rights reserved.
 * This code may only be used under the BSD style license found at
 * http://polymer.github.io/LICENSE.txt
 * The complete set of authors may be found at
 * http://polymer.github.io/AUTHORS.txt
 * The complete set of contributors may be found at
 * http://polymer.github.io/CONTRIBUTORS.txt
 * Code distributed by Google as part of the polymer project is also
 * subject to an additional IP rights grant found at
 * http://polymer.github.io/PATENTS.txt
 */
/**
 * @license
 * Copyright (c) 2017 The Polymer Project Authors. All rights reserved.
 * This code may only be used under the BSD style license found at
 * http://polymer.github.io/LICENSE.txt
 * The complete set of authors may be found at
 * http://polymer.github.io/AUTHORS.txt
 * The complete set of contributors may be found at
 * http://polymer.github.io/CONTRIBUTORS.txt
 * Code distributed by Google as part of the polymer project is also
 * subject to an additional IP rights grant found at
 * http://polymer.github.io/PATENTS.txt
 */
(window.litHtmlVersions||(window.litHtmlVersions=[])).push("1.1.2");const O=(t,...e)=>new g(t,e,"html",E)
/**
 * @license
 * Copyright (c) 2017 The Polymer Project Authors. All rights reserved.
 * This code may only be used under the BSD style license found at
 * http://polymer.github.io/LICENSE.txt
 * The complete set of authors may be found at
 * http://polymer.github.io/AUTHORS.txt
 * The complete set of contributors may be found at
 * http://polymer.github.io/CONTRIBUTORS.txt
 * Code distributed by Google as part of the polymer project is also
 * subject to an additional IP rights grant found at
 * http://polymer.github.io/PATENTS.txt
 */;function U(t,e){const{element:{content:s},parts:i}=t,n=document.createTreeWalker(s,133,null,!1);let o=M(i),r=i[o],a=-1,l=0;const h=[];let d=null;for(;n.nextNode();){a++;const t=n.currentNode;for(t.previousSibling===d&&(d=null),e.has(t)&&(h.push(t),null===d&&(d=t)),null!==d&&l++;void 0!==r&&r.index===a;)r.index=null!==d?-1:r.index-l,o=M(i,o),r=i[o]}h.forEach(t=>t.parentNode.removeChild(t))}const R=t=>{let e=11===t.nodeType?0:1;const s=document.createTreeWalker(t,133,null,!1);for(;s.nextNode();)e++;return e},M=(t,e=-1)=>{for(let s=e+1;s<t.length;s++){const e=t[s];if(c(e))return s}return-1};
/**
 * @license
 * Copyright (c) 2017 The Polymer Project Authors. All rights reserved.
 * This code may only be used under the BSD style license found at
 * http://polymer.github.io/LICENSE.txt
 * The complete set of authors may be found at
 * http://polymer.github.io/AUTHORS.txt
 * The complete set of contributors may be found at
 * http://polymer.github.io/CONTRIBUTORS.txt
 * Code distributed by Google as part of the polymer project is also
 * subject to an additional IP rights grant found at
 * http://polymer.github.io/PATENTS.txt
 */
const B=(t,e)=>`${t}--${e}`;let $=!0;void 0===window.ShadyCSS?$=!1:void 0===window.ShadyCSS.prepareTemplateDom&&(console.warn("Incompatible ShadyCSS version detected. Please update to at least @webcomponents/webcomponentsjs@2.0.2 and @webcomponents/shadycss@1.3.1."),$=!1);const j=t=>e=>{const s=B(e.type,t);let i=k.get(s);void 0===i&&(i={stringsArray:new WeakMap,keyString:new Map},k.set(s,i));let n=i.stringsArray.get(e.strings);if(void 0!==n)return n;const o=e.strings.join(r);if(n=i.keyString.get(o),void 0===n){const s=e.getTemplateElement();$&&window.ShadyCSS.prepareTemplateDom(s,t),n=new h(e,s),i.keyString.set(o,n)}return i.stringsArray.set(e.strings,n),n},z=["html","svg"],q=new Set,F=(t,e,s)=>{q.add(t);const i=s?s.element:document.createElement("template"),n=e.querySelectorAll("style"),{length:o}=n;if(0===o)return void window.ShadyCSS.prepareTemplateStyles(i,t);const r=document.createElement("style");for(let t=0;t<o;t++){const e=n[t];e.parentNode.removeChild(e),r.textContent+=e.textContent}(t=>{z.forEach(e=>{const s=k.get(B(e,t));void 0!==s&&s.keyString.forEach(t=>{const{element:{content:e}}=t,s=new Set;Array.from(e.querySelectorAll("style")).forEach(t=>{s.add(t)}),U(t,s)})})})(t);const a=i.content;s?function(t,e,s=null){const{element:{content:i},parts:n}=t;if(null==s)return void i.appendChild(e);const o=document.createTreeWalker(i,133,null,!1);let r=M(n),a=0,l=-1;for(;o.nextNode();){for(l++,o.currentNode===s&&(a=R(e),s.parentNode.insertBefore(e,s));-1!==r&&n[r].index===l;){if(a>0){for(;-1!==r;)n[r].index+=a,r=M(n,r);return}r=M(n,r)}}}(s,r,a.firstChild):a.insertBefore(r,a.firstChild),window.ShadyCSS.prepareTemplateStyles(i,t);const l=a.querySelector("style");if(window.ShadyCSS.nativeShadow&&null!==l)e.insertBefore(l.cloneNode(!0),e.firstChild);else if(s){a.insertBefore(r,a.firstChild);const t=new Set;t.add(r),U(s,t)}};window.JSCompiler_renameProperty=(t,e)=>t;const I={toAttribute(t,e){switch(e){case Boolean:return t?"":null;case Object:case Array:return null==t?t:JSON.stringify(t)}return t},fromAttribute(t,e){switch(e){case Boolean:return null!==t;case Number:return null===t?null:Number(t);case Object:case Array:return JSON.parse(t)}return t}},W=(t,e)=>e!==t&&(e==e||t==t),L={attribute:!0,type:String,converter:I,reflect:!1,hasChanged:W},H=Promise.resolve(!0);class D extends HTMLElement{constructor(){super(),this._updateState=0,this._instanceProperties=void 0,this._updatePromise=H,this._hasConnectedResolver=void 0,this._changedProperties=new Map,this._reflectingProperties=void 0,this.initialize()}static get observedAttributes(){this.finalize();const t=[];return this._classProperties.forEach((e,s)=>{const i=this._attributeNameForProperty(s,e);void 0!==i&&(this._attributeToPropertyMap.set(i,s),t.push(i))}),t}static _ensureClassProperties(){if(!this.hasOwnProperty(JSCompiler_renameProperty("_classProperties",this))){this._classProperties=new Map;const t=Object.getPrototypeOf(this)._classProperties;void 0!==t&&t.forEach((t,e)=>this._classProperties.set(e,t))}}static createProperty(t,e=L){if(this._ensureClassProperties(),this._classProperties.set(t,e),e.noAccessor||this.prototype.hasOwnProperty(t))return;const s="symbol"==typeof t?Symbol():`__${t}`;Object.defineProperty(this.prototype,t,{get(){return this[s]},set(e){const i=this[t];this[s]=e,this._requestUpdate(t,i)},configurable:!0,enumerable:!0})}static finalize(){const t=Object.getPrototypeOf(this);if(t.hasOwnProperty("finalized")||t.finalize(),this.finalized=!0,this._ensureClassProperties(),this._attributeToPropertyMap=new Map,this.hasOwnProperty(JSCompiler_renameProperty("properties",this))){const t=this.properties,e=[...Object.getOwnPropertyNames(t),..."function"==typeof Object.getOwnPropertySymbols?Object.getOwnPropertySymbols(t):[]];for(const s of e)this.createProperty(s,t[s])}}static _attributeNameForProperty(t,e){const s=e.attribute;return!1===s?void 0:"string"==typeof s?s:"string"==typeof t?t.toLowerCase():void 0}static _valueHasChanged(t,e,s=W){return s(t,e)}static _propertyValueFromAttribute(t,e){const s=e.type,i=e.converter||I,n="function"==typeof i?i:i.fromAttribute;return n?n(t,s):t}static _propertyValueToAttribute(t,e){if(void 0===e.reflect)return;const s=e.type,i=e.converter;return(i&&i.toAttribute||I.toAttribute)(t,s)}initialize(){this._saveInstanceProperties(),this._requestUpdate()}_saveInstanceProperties(){this.constructor._classProperties.forEach((t,e)=>{if(this.hasOwnProperty(e)){const t=this[e];delete this[e],this._instanceProperties||(this._instanceProperties=new Map),this._instanceProperties.set(e,t)}})}_applyInstanceProperties(){this._instanceProperties.forEach((t,e)=>this[e]=t),this._instanceProperties=void 0}connectedCallback(){this._updateState=32|this._updateState,this._hasConnectedResolver&&(this._hasConnectedResolver(),this._hasConnectedResolver=void 0)}disconnectedCallback(){}attributeChangedCallback(t,e,s){e!==s&&this._attributeToProperty(t,s)}_propertyToAttribute(t,e,s=L){const i=this.constructor,n=i._attributeNameForProperty(t,s);if(void 0!==n){const t=i._propertyValueToAttribute(e,s);if(void 0===t)return;this._updateState=8|this._updateState,null==t?this.removeAttribute(n):this.setAttribute(n,t),this._updateState=-9&this._updateState}}_attributeToProperty(t,e){if(8&this._updateState)return;const s=this.constructor,i=s._attributeToPropertyMap.get(t);if(void 0!==i){const t=s._classProperties.get(i)||L;this._updateState=16|this._updateState,this[i]=s._propertyValueFromAttribute(e,t),this._updateState=-17&this._updateState}}_requestUpdate(t,e){let s=!0;if(void 0!==t){const i=this.constructor,n=i._classProperties.get(t)||L;i._valueHasChanged(this[t],e,n.hasChanged)?(this._changedProperties.has(t)||this._changedProperties.set(t,e),!0!==n.reflect||16&this._updateState||(void 0===this._reflectingProperties&&(this._reflectingProperties=new Map),this._reflectingProperties.set(t,n))):s=!1}!this._hasRequestedUpdate&&s&&this._enqueueUpdate()}requestUpdate(t,e){return this._requestUpdate(t,e),this.updateComplete}async _enqueueUpdate(){let t,e;this._updateState=4|this._updateState;const s=this._updatePromise;this._updatePromise=new Promise((s,i)=>{t=s,e=i});try{await s}catch(t){}this._hasConnected||await new Promise(t=>this._hasConnectedResolver=t);try{const t=this.performUpdate();null!=t&&await t}catch(t){e(t)}t(!this._hasRequestedUpdate)}get _hasConnected(){return 32&this._updateState}get _hasRequestedUpdate(){return 4&this._updateState}get hasUpdated(){return 1&this._updateState}performUpdate(){this._instanceProperties&&this._applyInstanceProperties();let t=!1;const e=this._changedProperties;try{t=this.shouldUpdate(e),t&&this.update(e)}catch(e){throw t=!1,e}finally{this._markUpdated()}t&&(1&this._updateState||(this._updateState=1|this._updateState,this.firstUpdated(e)),this.updated(e))}_markUpdated(){this._changedProperties=new Map,this._updateState=-5&this._updateState}get updateComplete(){return this._getUpdateComplete()}_getUpdateComplete(){return this._updatePromise}shouldUpdate(t){return!0}update(t){void 0!==this._reflectingProperties&&this._reflectingProperties.size>0&&(this._reflectingProperties.forEach((t,e)=>this._propertyToAttribute(e,this[e],t)),this._reflectingProperties=void 0)}updated(t){}firstUpdated(t){}}D.finalized=!0;
/**
 * @license
 * Copyright (c) 2017 The Polymer Project Authors. All rights reserved.
 * This code may only be used under the BSD style license found at
 * http://polymer.github.io/LICENSE.txt
 * The complete set of authors may be found at
 * http://polymer.github.io/AUTHORS.txt
 * The complete set of contributors may be found at
 * http://polymer.github.io/CONTRIBUTORS.txt
 * Code distributed by Google as part of the polymer project is also
 * subject to an additional IP rights grant found at
 * http://polymer.github.io/PATENTS.txt
 */
const J=(t,e)=>"method"===e.kind&&e.descriptor&&!("value"in e.descriptor)?Object.assign({},e,{finisher(s){s.createProperty(e.key,t)}}):{kind:"field",key:Symbol(),placement:"own",descriptor:{},initializer(){"function"==typeof e.initializer&&(this[e.key]=e.initializer.call(this))},finisher(s){s.createProperty(e.key,t)}};function G(t){return(e,s)=>void 0!==s?((t,e,s)=>{e.constructor.createProperty(s,t)})(t,e,s):J(t,e)}
/**
@license
Copyright (c) 2019 The Polymer Project Authors. All rights reserved.
This code may only be used under the BSD style license found at
http://polymer.github.io/LICENSE.txt The complete set of authors may be found at
http://polymer.github.io/AUTHORS.txt The complete set of contributors may be
found at http://polymer.github.io/CONTRIBUTORS.txt Code distributed by Google as
part of the polymer project is also subject to an additional IP rights grant
found at http://polymer.github.io/PATENTS.txt
*/const K="adoptedStyleSheets"in Document.prototype&&"replace"in CSSStyleSheet.prototype,Y=Symbol();class Z{constructor(t,e){if(e!==Y)throw new Error("CSSResult is not constructable. Use `unsafeCSS` or `css` instead.");this.cssText=t}get styleSheet(){return void 0===this._styleSheet&&(K?(this._styleSheet=new CSSStyleSheet,this._styleSheet.replaceSync(this.cssText)):this._styleSheet=null),this._styleSheet}toString(){return this.cssText}}const Q=(t,...e)=>{const s=e.reduce((e,s,i)=>e+(t=>{if(t instanceof Z)return t.cssText;if("number"==typeof t)return t;throw new Error(`Value passed to 'css' function must be a 'css' function result: ${t}. Use 'unsafeCSS' to pass non-literal values, but\n            take care to ensure page security.`)})(s)+t[i+1],t[0]);return new Z(s,Y)};
/**
 * @license
 * Copyright (c) 2017 The Polymer Project Authors. All rights reserved.
 * This code may only be used under the BSD style license found at
 * http://polymer.github.io/LICENSE.txt
 * The complete set of authors may be found at
 * http://polymer.github.io/AUTHORS.txt
 * The complete set of contributors may be found at
 * http://polymer.github.io/CONTRIBUTORS.txt
 * Code distributed by Google as part of the polymer project is also
 * subject to an additional IP rights grant found at
 * http://polymer.github.io/PATENTS.txt
 */
(window.litElementVersions||(window.litElementVersions=[])).push("2.2.1");const X=t=>t.flat?t.flat(1/0):function t(e,s=[]){for(let i=0,n=e.length;i<n;i++){const n=e[i];Array.isArray(n)?t(n,s):s.push(n)}return s}(t);class tt extends D{static finalize(){super.finalize.call(this),this._styles=this.hasOwnProperty(JSCompiler_renameProperty("styles",this))?this._getUniqueStyles():this._styles||[]}static _getUniqueStyles(){const t=this.styles,e=[];if(Array.isArray(t)){X(t).reduceRight((t,e)=>(t.add(e),t),new Set).forEach(t=>e.unshift(t))}else t&&e.push(t);return e}initialize(){super.initialize(),this.renderRoot=this.createRenderRoot(),window.ShadowRoot&&this.renderRoot instanceof window.ShadowRoot&&this.adoptStyles()}createRenderRoot(){return this.attachShadow({mode:"open"})}adoptStyles(){const t=this.constructor._styles;0!==t.length&&(void 0===window.ShadyCSS||window.ShadyCSS.nativeShadow?K?this.renderRoot.adoptedStyleSheets=t.map(t=>t.styleSheet):this._needsShimAdoptedStyleSheets=!0:window.ShadyCSS.ScopingShim.prepareAdoptedCssText(t.map(t=>t.cssText),this.localName))}connectedCallback(){super.connectedCallback(),this.hasUpdated&&void 0!==window.ShadyCSS&&window.ShadyCSS.styleElement(this)}update(t){super.update(t);const e=this.render();e instanceof g&&this.constructor.render(e,this.renderRoot,{scopeName:this.localName,eventContext:this}),this._needsShimAdoptedStyleSheets&&(this._needsShimAdoptedStyleSheets=!1,this.constructor._styles.forEach(t=>{const e=document.createElement("style");e.textContent=t.cssText,this.renderRoot.appendChild(e)}))}render(){}}tt.finalized=!0,tt.render=(t,e,s)=>{if(!s||"object"!=typeof s||!s.scopeName)throw new Error("The `scopeName` option is required.");const n=s.scopeName,o=V.has(e),r=$&&11===e.nodeType&&!!e.host,a=r&&!q.has(n),l=a?document.createDocumentFragment():e;if(((t,e,s)=>{let n=V.get(e);void 0===n&&(i(e,e.firstChild),V.set(e,n=new S(Object.assign({templateFactory:A},s))),n.appendInto(e)),n.setValue(t),n.commit()})(t,l,Object.assign({templateFactory:j(n)},s)),a){const t=V.get(l);V.delete(l);const s=t.value instanceof f?t.value.template:void 0;F(n,l,s),i(e,e.firstChild),e.appendChild(l),V.set(e,t)}!o&&r&&window.ShadyCSS.styleElement(e.host)};var et=function(t,e,s,i){var n,o=arguments.length,r=o<3?e:null===i?i=Object.getOwnPropertyDescriptor(e,s):i;if("object"==typeof Reflect&&"function"==typeof Reflect.decorate)r=Reflect.decorate(t,e,s,i);else for(var a=t.length-1;a>=0;a--)(n=t[a])&&(r=(o<3?n(r):o>3?n(e,s,r):n(e,s))||r);return o>3&&r&&Object.defineProperty(e,s,r),r};let st=class extends tt{constructor(){super(...arguments),this.swpath="firebase-messaging-sw.js",this.updateevent="SKIP_WAITING",this.updatemessage="An update for this app is available",this.readyToAsk=!1,this.showStorageEstimate=!1,this.showOfflineToast=!1,this.offlineToastDuration=2400,this.storageUsed=null}static get styles(){return Q`:host{font-family:sans-serif;--toast-background:#3c3c3c;--button-background:#0b0b0b}#updateToast{position:absolute;bottom:16px;right:16px;background:var(--toast-background);color:#fff;padding:1em;border-radius:4px;display:flex;align-items:center;justify-content:space-between;min-width:22em;font-weight:600;animation-name:fadein;animation-duration:.3s}#storageToast{position:absolute;bottom:16px;right:16px;background:var(--toast-background);color:#fff;padding:1em;border-radius:4px;display:flex;flex-direction:column;align-items:flex-end;font-weight:600}#storageEstimate{font-size:10px;margin-top:8px}#updateToast button{color:#fff;border:none;background:var(--button-background);padding:8px;border-radius:24px;text-transform:lowercase;padding-left:14px;padding-right:14px;font-weight:700}@keyframes fadein{from{opacity:0}to{opacity:1}}`}async firstUpdated(){if(this.swpath&&"serviceWorker"in navigator){const t=await navigator.serviceWorker.register(this.swpath);if(t.installing&&navigator.storage){const t=await navigator.storage.estimate();if(t){this.storageUsed=this.formatBytes(t.usage),this.showOfflineToast=!0,await this.updateComplete;const e=this.shadowRoot.querySelector("#storageToast").animate([{opacity:0},{opacity:1}],{fill:"forwards",duration:280});setTimeout(async()=>{e.onfinish=()=>{this.showOfflineToast=!1},await e.reverse()},this.offlineToastDuration)}}t.onupdatefound=async()=>{let e=t.installing;e.onstatechange=()=>{"installed"===e.state&&this.dispatchEvent(new Event("pwaUpdate"))}}}this.setupEvents()}setupEvents(){this.addEventListener("pwaUpdate",async()=>{navigator.serviceWorker&&(this.swreg=await navigator.serviceWorker.getRegistration(),this.swreg&&this.swreg.waiting&&(this.readyToAsk=!0))})}doUpdate(){this.swreg.waiting.postMessage({type:this.updateevent}),window.location.reload()}formatBytes(t,e=2){if(0===t)return"0 Bytes";const s=e<0?0:e,i=Math.floor(Math.log(t)/Math.log(1024));return parseFloat((t/Math.pow(1024,i)).toFixed(s))+" "+["Bytes","KB","MB","GB","TB","PB","EB","ZB","YB"][i]}render(){return O`<div>${this.readyToAsk?O`<div id=updateToast part=updateToast><span>${this.updatemessage}</span> <button @click=${()=>this.doUpdate()}>Update</button></div>`:null} ${this.showOfflineToast?O`<div style="z-index:100000" id=storageToast part=offlineToast>Ready to use Offline ${this.showStorageEstimate?O`<span id=storageEstimate>Cached ${this.storageUsed}</span>`:null}</div>`:null}</div>`}};var it;et([G({type:String})],st.prototype,"swpath",void 0),et([G({type:String})],st.prototype,"updateevent",void 0),et([G({type:String})],st.prototype,"updatemessage",void 0),et([G({type:Boolean})],st.prototype,"readyToAsk",void 0),et([G({type:Boolean})],st.prototype,"showStorageEstimate",void 0),et([G({type:Boolean})],st.prototype,"showOfflineToast",void 0),et([G({type:Number})],st.prototype,"offlineToastDuration",void 0),et([G({type:String})],st.prototype,"storageUsed",void 0),st=et([(it="pwa-update",t=>"function"==typeof t?((t,e)=>(window.customElements.define(t,e),e))(it,t):((t,e)=>{const{kind:s,elements:i}=e;return{kind:s,elements:i,finisher(e){window.customElements.define(t,e)}}})(it,t))],st);export{st as pwaupdate};
//# sourceMappingURL=pwa-update.js.map

const el = document.createElement('pwa-update');
document.body.appendChild(el);
  </script>

  
  <script>

if ('serviceWorker' in navigator) {
  window.addEventListener('load', function() {
    navigator.serviceWorker.register('../firebase-messaging-sw.js')
      .then(reg => {
        console.log('Service worker registered! 😎', reg);
      })
      .catch(err => {
        console.log('😥 Service worker registration failed: ', err);
      });
  });
}
  </script>
</head>

<body>
  <div class="app" id="app">

<!-- ############ LAYOUT START-->

<!-----aside--->
<?php include('include/aside.php'); ?>

  
  <!-- content -->
  <div id="content"  class="app-content box-shadow-z0" role="main">

<!--- Top main Nav -->
<?php include('include/top-nav.php'); ?>

   
    <div ui-view class="app-body" id="view">
	
<?php
$sql = "SELECT*from users where username='$_SESSION[username]' ";
$query=mysqli_query($conn,$sql);
$row = mysqli_fetch_array($query);
if($row['active_room']!='')
{include('chat-room.php');}
else{include('include/room-list.php');}
 ?>
<!-- ############ PAGE START-->

        </div>
		
    </div>

	</div>
<!-- ############ PAGE END-->




 
  <!---Theme change settings script-->

 <?php include('include/theme-script.php'); ?>
<div class="modal fade" id="profile_2"  style='z-index:2002;' role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content col-xs-#" id='profile-info-modal-data' style='padding:0;'>
      
      
     
     
    </div>
  </div>
</div>

<script>

$('body').delegate(".user-profile-trigger-class","click",function(){
	$.get('include/profile-info-modal-data.php',{profile_user_id: $(this).attr('value')},function(output){$('#profile-info-modal-data').empty();$('#profile-info-modal-data').append(output);});
});



	
	var update_room_members=function()
{
	$('.members-list-ul').load('include/room-members.php')
	$('.members-list-ul-phone').load('include/room-members.php')
	$('.room_list_right').load('include/room-list-right.php')
}

	$(document).ready(function() {

$.get('include/update-active-status.php');
update_room_members();
});

var update_active=function()
{
$.get('include/update-active-status.php');
}

setInterval(update_active,30000);



 // var check_session=function()
 // {
  
 // $.get('include/check-session.php',{},function(output){if(output!='1'){$('#view').hide();window.location.replace("signin.php");}});
 // }
 // setInterval(check_session,1000);

var count_new_pm_and_noti=function ()
{
$.get('include/count_new_pm.php',function(output){if(output>0){$('#red_indicator').empty();$('#red_indicator').append("<span class='label up rounded danger pm_count_value'>"+output+"</span>");}else{$('#red_indicator').empty();}});

$.get('include/count-notification.php',function(output_2){if(output_2>0){$('#yellow_indicator').empty();$('#yellow_indicator').append("<span class='label up rounded warn pm_count_value'>"+output_2+"</span>");}else{$('#yellow_indicator').empty();}});


}


</script>

<!-- Bootstrap -->
  <script src="../libs/jquery/tether/dist/js/tether.min.js"></script>
  <script src="../libs/jquery/bootstrap/dist/js/bootstrap.js"></script>
<!-- core -->
  <script src="../libs/jquery/underscore/underscore-min.js"></script>
  <script src="../libs/jquery/jQuery-Storage-API/jquery.storageapi.min.js"></script>

<script src="scripts/jquery.timeago.js" type="text/javascript"></script>
  <script src="scripts/config.lazyload.js"></script>

  <script src="scripts/palette.js"></script>
  <script src="scripts/ui-load.js"></script>
  
  <script src="scripts/ui-jp.js"></script>
  <script src="scripts/ui-include.js"></script>
  <script src="scripts/ui-device.js"></script>
  <script src="scripts/ui-form.js"></script>
  <script src="scripts/ui-nav.js"></script>
  <script src="scripts/ui-screenfull.js"></script>
  <script src="scripts/ui-scroll-to.js"></script>
  <script src="scripts/ui-toggle-class.js"></script>

  <script src="scripts/app.js"></script>

  <!-- ajax -->
  <script src="../libs/jquery/jquery-pjax/jquery.pjax.js"></script>
  <script src="scripts/ajax.js"></script>
<!-- endbuild -->
<script>
jQuery(document).ready(function() {
  jQuery("time.timeago").timeago();
});
</script>


<script>


$('#personal-chat-form').submit(function(){ return false; });
$('body').on('click','#send_pm_btn',function(){
		$.post('include/send-pm.php',$('#personal-chat-form :input').serializeArray(),function(output)
	{
		if(output==1){$("#personal-chat-form").trigger("reset");
		var ws_data=JSON.stringify({"data":$('#receiver_id').val(),"action":"update_pm"});
         	conn.send(ws_data);
			check_pm();	
         count_new_pm_and_noti();
		$('.emoji_picker_plate_pm').stop().hide(250);check_pm();}console.log(output);
	}
	);
});

</script>
<?php 
	$username=$_SESSION['username'];
$sql = "SELECT*from users where username='$username' ";
$query=mysqli_query($conn,$sql);
$row = mysqli_fetch_array($query);
$user_id=$row['user_id'];
?>
<script>
document.addEventListener("DOMContentLoaded", function() {
  count_new_pm_and_noti();
  $.get('include/check-session.php',{},function(output){if(output!='1'){$('#view').hide();window.location.replace("signin.php");}});
});



$(window).on('resize', function(event){
    var windowWidth = $(window).width();
if(windowWidth > 576){
  $('#aside_2').modal('hide');
}
});




$('body').on('click','.room_chat_thumbs',function(){
	$('#img_original_loading').show();
	var raw_img_path=$(this).attr('src');
	var origina_img_path=raw_img_path.replace('/thumbnails/thumb_x_sm_','/');
	$('#original_image_display_body').html("<button type='button' style='background:none;border:none;cursor:pointer;' data-dismiss='modal' aria-label='Close'><span aria-hidden='true' class='text-danger' style='font-size:20px;'><i class='fa fa-times-circle mx-auto d-block'></i></span></button><br/><img style=' max-height:90vh;' class='img-thumbnail original_image_on_modal' src="+origina_img_path+"></img>");
	
	$('.original_image_on_modal').on('load',function(){
		
	$('#img_original_loading').hide();	
	});
	
});
$("body").delegate(".msg_button", "click", function(){
   $('#aside_2').modal('hide');
});

 
	
$("body").delegate(".my-profile-btn", "click", function(){
		$.get('include/my-profile.php',{},function(output){
			 $(".main-bdy").html(output);
   $('#aside').modal('hide');
   $('#msg-input-div-2').hide();
});});	



conn.onmessage = function(e) {
	var obj = JSON.parse(e.data);
	switch(obj.action) {
  case "update_room_msg":
    if(myrmdat==obj.data){
	check();}
    break;
  case "update_dlt_room_msg":
  
    $("small[msgid='"+obj.data+"']").closest('.msg_div_box').remove();
	
	break;
  case "update_pm":
    if(`<?php echo $user_id;?>`==obj.data){ 
  
    check_pm();
	count_new_pm_and_noti();
	
	}
    break;
  case "update_members":
    if(myrmdat==obj.data){
	update_room_members();}
    break;
  case "update_notifications":
    if(`<?php echo $user_id;?>`==obj.data){
	count_new_pm_and_noti();
	}
    break;
	///////////////////////////////////////////////////////////////check here to change for notification due to other triggers like friend requests
 }};	





</script>
  <script>
	  $('body').delegate('.add_friend_btn','click',function(){
		   var t=$(this);
		$.post('include/add-friend.php',{user_id: $(this).parent().find('.user_id_hidden').val()},function(output){if(output==1){
			$('.add_friend_btn').addClass('disabled_btn');
			var ws_data=JSON.stringify({"data":$('.user_id_hidden').val(),"action":"update_notifications"});
	conn.send(ws_data);
			$.get('include/profile-info-modal-data.php',{profile_user_id: t.parent().find('.user_id_hidden').val()},function(output){$('#profile-info-modal-data').empty();$('#profile-info-modal-data').append(output);});
			}else{};}); 
	 });
	 
      $('body').delegate('.block_person_btn','click',function(){	
	  var t=$(this);
		$.post('include/block-person.php',{user_id: $(this).parent().find('.user_id_hidden').val()},function(output){if(output==1){
			$('.block_person_btn').addClass('disabled_btn');
			var ws_data=JSON.stringify({"data":$('.user_id_hidden').val(),"action":"update_notifications"});
	conn.send(ws_data);
	count_new_pm_and_noti();
			$.get('include/profile-info-modal-data.php',{profile_user_id: t.parent().find('.user_id_hidden').val()},function(output){$('#profile-info-modal-data').empty();$('#profile-info-modal-data').append(output);});}else{};}); 
	 });
	 
	 
	  $('body').delegate('.remove_frnd_btn','click',function(){	
	   var t=$(this);
		$.post('include/remove-friend.php',{user_id: $(this).parent().find('.user_id_hidden').val()},function(output){if(output==1){
			$('.remove_frnd_btn').addClass('disabled_btn');
			$.get('include/profile-info-modal-data.php',{profile_user_id: t.parent().find('.user_id_hidden').val()},function(output){$('#profile-info-modal-data').empty();$('#profile-info-modal-data').append(output);});
			}else{};}); 
	 });
	 
	 
	 
	   $('body').delegate('.cancel_req_btn','click',function(){	
	   var t = $(this);
		$.post('include/remove-friend.php',{user_id: $(this).parent().find('.user_id_hidden').val()},function(output){if(output==1){
			t.closest('.list-item').fadeOut("slow",function(){
				$(this).remove();
			});
			$('.cancel_req_btn').addClass('disabled_btn');
			count_new_pm_and_noti();
			var ws_data=JSON.stringify({"data":$('.user_id_hidden').val(),"action":"update_notifications"});
	conn.send(ws_data);
	$.get('include/profile-info-modal-data.php',{profile_user_id: t.parent().find('.user_id_hidden').val()},function(output){$('#profile-info-modal-data').empty();$('#profile-info-modal-data').append(output);});}else{};}); 
	 });
	 
	 
	 
	  $('body').delegate('.accpt_req_btn','click',function(){	
	   var t = $(this);
		$.post('include/accept-request.php',{user_id: $(this).parent().find('.user_id_hidden').val()},function(output){if(output==1){
			t.closest('.list-item').fadeOut("slow",function(){
				$(this).remove();
			});
			$('.accpt_req_btn').addClass('disabled_btn');
			count_new_pm_and_noti();
			var ws_data=JSON.stringify({"data":$('.user_id_hidden').val(),"action":"update_notifications"});
	conn.send(ws_data);
			$.get('include/profile-info-modal-data.php',{profile_user_id: t.parent().find('.user_id_hidden').val()},function(output){$('#profile-info-modal-data').empty();$('#profile-info-modal-data').append(output);});
			}else{};}); 
	 });
	 
	 
	 
	 $('body').delegate('.unblock_person_btn','click',function(){
        var t=$(this);		 
		$.post('include/unblock-person.php',{user_id: $(this).parent().find('.user_id_hidden').val()},function(output){if(output==1){
			$('.unblock_person_btn').addClass('disabled_btn');
			$.get('include/profile-info-modal-data.php',{profile_user_id: t.parent().find('.user_id_hidden').val()},function(output){$('#profile-info-modal-data').empty();$('#profile-info-modal-data').append(output);});
			}else{};}); 
	 });
	
	
	
	 </script>
	 <script>
  window.addEventListener('beforeinstallprompt', e => {
  e.preventDefault()
  deferredPrompt = e
})

const btnInstallApp = document.getElementById('installBtn');

if(btnInstallApp) {
  btnInstallApp.addEventListener('click', e => {
    deferredPrompt.prompt()
    deferredPrompt.userChoice
      .then(choiceResult => {
        if(choiceResult.outcome === 'accepted') {
          console.log('user accepted A2HS prompt')
        } else {
          console.log('user dismissed A2HS prompt')
        }
        deferredPrompt = null
      })
    })
}
  </script>
<body>
  <!-- Insert these scripts at the bottom of the HTML, but before you use any Firebase services -->

  <!-- Firebase App (the core Firebase SDK) is always required and must be listed first -->
  <script src="https://www.gstatic.com/firebasejs/7.14.2/firebase-app.js"></script>

  <!-- If you enabled Analytics in your project, add the Firebase SDK for Analytics -->
  <script src="https://www.gstatic.com/firebasejs/7.14.2/firebase-analytics.js"></script>

  <!-- Add Firebase products that you want to use -->
  <script src="https://www.gstatic.com/firebasejs/7.14.2/firebase-auth.js"></script>
  <script src="https://www.gstatic.com/firebasejs/7.14.2/firebase-firestore.js"></script>
  <script src="https://www.gstatic.com/firebasejs/7.14.2/firebase-messaging.js"></script> 





<script>

  var firebaseConfig = {
    apiKey: "AIzaSyAfZQ2O4HlTYVN-4OS1hyqohZKayTSw30I",
    authDomain: "mychathub-1e972.firebaseapp.com",
    databaseURL: "https://mychathub-1e972.firebaseio.com",
    projectId: "mychathub-1e972",
    storageBucket: "mychathub-1e972.appspot.com",
    messagingSenderId: "1051241791311",
    appId: "1:1051241791311:web:46da4f359b5bb5d5740f3a",
    measurementId: "G-Z4DFP4RG9N"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  
  
  const messaging = firebase.messaging();
  messaging.requestPermission()
  .then(function(){
	  console.log("Have Permission");
	  return messaging.getToken();
  })
  .then(function(token){
	   $.post('include/save-token.php',{token_id: token},function(output){
if(output==11){console.log();}else{}		   
			 });
  })
  .catch(function(err){
	  console.log("error"); 
})
messaging.onMessage(function(payload){
  
});


$.post('include/save-session-id.php',{},function(output){});

</script>

</body>
</html>
