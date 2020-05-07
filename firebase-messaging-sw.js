importScripts('https://www.gstatic.com/firebasejs/7.14.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.14.2/firebase-messaging.js');

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
  


importScripts('https://storage.googleapis.com/workbox-cdn/releases/5.0.0/workbox-sw.js');

const HTML_CACHE = "html";
const JS_CACHE = "javascript";
const STYLE_CACHE = "stylesheets";
const IMAGE_CACHE = "images";
const FONT_CACHE = "fonts";

self.addEventListener("message", (event) => {
  if (event.data && event.data.type === "SKIP_WAITING") {
    self.skipWaiting();
  }
});

workbox.routing.registerRoute(
  ({event}) => event.request.destination === 'document',
  new workbox.strategies.NetworkFirst({
    cacheName: HTML_CACHE,
    plugins: [
      new workbox.expiration.ExpirationPlugin({
        maxEntries: 10,
      }),
    ],
  })
);

workbox.routing.registerRoute(
  ({event}) => event.request.destination === 'script',
  new workbox.strategies.StaleWhileRevalidate({
    cacheName: JS_CACHE,
    plugins: [
      new workbox.expiration.ExpirationPlugin({
        maxEntries: 15,
      }),
    ],
  })
);

workbox.routing.registerRoute(
  ({event}) => event.request.destination === 'style',
  new workbox.strategies.StaleWhileRevalidate({
    cacheName: STYLE_CACHE,
    plugins: [
      new workbox.expiration.ExpirationPlugin({
        maxEntries: 15,
      }),
    ],
  })
);

workbox.routing.registerRoute(
  ({event}) => event.request.destination === 'image',
  new workbox.strategies.StaleWhileRevalidate({
    cacheName: IMAGE_CACHE,
    plugins: [
      new workbox.expiration.ExpirationPlugin({
        maxEntries: 15,
      }),
    ],
  })
);

workbox.routing.registerRoute(
  ({event}) => event.request.destination === 'font',
  new workbox.strategies.StaleWhileRevalidate({
    cacheName: FONT_CACHE,
    plugins: [
      new workbox.expiration.ExpirationPlugin({
        maxEntries: 15,
      }),
    ],
  })
);
var x=1;
function isClientFocused() {
  return clients.matchAll({
    type: 'window',
    includeUncontrolled: true
  }).then((windowClients) => {
    let clientIsFocused = false;

    for (let i = 0; i < windowClients.length; i++) {
      const windowClient = windowClients[i];
      if (windowClient.focused) {
        clientIsFocused = true;
        break;
      }
    }

    return clientIsFocused;
  });
}
self.addEventListener('push', function(event) {

    var title = 'MyChatHub';
    var body = {
        'body': x+' New Message Received',
        'tag': 'msg',
        'icon': '../images/touch/icon-192x192.png',
        'badge': '../images/touch/icon-192x192.png',
        actions: [
          {action: 'open', title: 'Open'},
          {action: 'close', title: 'Close'},
        ]
    };
	const promiseChain = isClientFocused()
.then((clientIsFocused) => {
  if (clientIsFocused) {
    console.log();
    return;

  }

  // Client isn't focused, we need to show a notification.
  return self.registration.showNotification(title,body);

});

x++; 
event.waitUntil(promiseChain);
});

self.addEventListener('notificationclick', function(event) {

  event.notification.close();                             

 if (event.action === 'close') {                         
    event.notification.close();
  }
  else {
    clients.openWindow('./chatroom');
x=1;     
  }
}, false);
