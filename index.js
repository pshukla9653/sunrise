//---register the Service Worker---
window.addEventListener('load', e => {
 if ('serviceWorker' in navigator) {
  navigator.serviceWorker.register('sw.js');
  navigator.serviceWorker.ready.then(registration => {
    if ('PushManager' in window) {
      document.querySelector('button.subscribe-for-push')
        .addEventListener('click', () => registerForPush(registration.pushManager));
    }
  });
}

	
});

