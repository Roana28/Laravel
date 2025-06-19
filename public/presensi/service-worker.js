// public/presensi/service-worker.js
self.addEventListener('install', function (event) {
  console.log('✅ Service Worker installed.');
});

self.addEventListener('fetch', function (event) {
  // Bisa diisi caching logic jika butuh
});
