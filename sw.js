var cacheName = 'aquent-pwa';
var filesToCache = [
  '/',
  '/index.php',
  '/assets/backend/assets/css/bootstrap.css',
  '/assets/backend/assets/css/core.css',
  '/assets/backend/assets/css/components.css',
  '/index.js'
];

/* Start the service worker and cache all of the app's content */
self.addEventListener('install', async function(e) {
  e.waitUntil(
    caches.open(cacheName).then(function(cache) {
      return cache.addAll(filesToCache);
    })
  );
  self.skipWaiting();
});

/* Serve cached content when offline */
self.addEventListener('fetch', async function(e) {
  e.respondWith(
    caches.match(e.request).then(function(response) {
      return response || fetch(e.request);
    })
  );
});

