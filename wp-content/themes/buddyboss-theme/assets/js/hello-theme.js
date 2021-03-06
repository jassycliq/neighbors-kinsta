/**
 * Loads for Hello Theme in wp-admin for query string `hello=theme`.
 *
 *
 */
(function () {
    /**
     * Open the Hello BuddyBoss modal.
     */
    var theme_hello_open_modal = function () {
        var backdrop = document.getElementById('theme-hello-backdrop'),
            modal = document.getElementById('theme-hello-container');
    
        if ( modal ) {
            if ( modal.classList.contains( 'bb-theme-modal-onload' ) ) {
                document.body.classList.add( 'theme-disable-scroll' );
            
                // Show modal and overlay.
                backdrop.style.display = '';
                modal.style.display = '';
            
                // Focus the "X" so bp_hello_handle_keyboard_events() works.
                var focus_target = modal.querySelectorAll( 'a[href], button' );
                focus_target = Array.prototype.slice.call( focus_target );
                focus_target[0].focus();
            }
            // Events.
            modal.addEventListener('keydown', bp_hello_handle_keyboard_events);
        }
        if ( backdrop ) {
            backdrop.addEventListener( 'click', bp_hello_close_modal );
        }
    };

    /**
     * Close modal if "X" or background is touched.
     *
     * @param {Event} event - A click event.
     */
    document.addEventListener('click', function (event) {
        var backdrop = document.getElementById('theme-hello-backdrop');
        if (!backdrop || !document.getElementById('theme-hello-container')) {
            return;
        }

        var backdrop_click = backdrop.contains(event.target),
            modal_close_click = event.target.classList.contains('close-modal');

        if (!modal_close_click && !backdrop_click) {
            return;
        }

        bp_hello_close_modal();
    }, false);

    /**
     * Close the Hello modal.
     */
    var bp_hello_close_modal = function () {
        var backdrop = document.getElementById('theme-hello-backdrop'),
            modal = document.getElementById('theme-hello-container');

        document.body.classList.remove('theme-disable-scroll');

        if ( ! modal.classList.contains( 'bb-update-theme-modal' ) ) {
            // Remove modal and overlay.
            modal.parentNode.removeChild( modal );
            backdrop.parentNode.removeChild( backdrop );
        } else {
            // Hide modal and overlay.
            backdrop.style.display = 'none';
            modal.style.display = 'none';
        }
    };

    /**
     * Restrict keyboard focus to elements within the Hello BuddyBoss modal.
     *
     * @param {Event} event - A keyboard focus event.
     */
    var bp_hello_handle_keyboard_events = function (event) {
        var modal = document.getElementById('theme-hello-container'),
            focus_targets = Array.prototype.slice.call(
                modal.querySelectorAll('a[href], button')
            ),
            first_tab_stop = focus_targets[0],
            last_tab_stop = focus_targets[focus_targets.length - 1];

        // Check for TAB key press.
        if (event.keyCode !== 9) {
            return;
        }

        // When SHIFT+TAB on first tab stop, go to last tab stop in modal.
        if (event.shiftKey && document.activeElement === first_tab_stop) {
            event.preventDefault();
            last_tab_stop.focus();

            // When TAB reaches last tab stop, go to first tab stop in modal.
        } else if (document.activeElement === last_tab_stop) {
            event.preventDefault();
            first_tab_stop.focus();
        }
    };

    /**
     * Close modal if escape key is presssed.
     *
     * @param {Event} event - A keyboard focus event.
     */
    document.addEventListener('keyup', function (event) {
        if (event.keyCode === 27) {
            if (!document.getElementById('theme-hello-backdrop') || !document.getElementById('theme-hello-container')) {
                return;
            }

            bp_hello_close_modal();
        }
    }, false);

    // Init modal after the screen's loaded.
    if (document.attachEvent ? document.readyState === 'complete' : document.readyState !== 'loading') {
        theme_hello_open_modal();
    } else {
        document.addEventListener('DOMContentLoaded', theme_hello_open_modal);
    }
}());

