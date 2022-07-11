
      jQuery(document).ready(function($) {
        let $el = $('#togglePassword'),
          $code = $el.find('code'),
          orig = $code.text();

        function toggle() {
          if (navigator.onLine) {
            $el.addClass('hidden');
            $code.text(orig);
          } else {
            $el.removeClass('hidden');
            $code.text(atob(orig));
          }
        }

        $(window).on('online offline', toggle);
        // window.addEventListener('online', toggle);
        // window.addEventListener('offline', toggle);
      });
    
