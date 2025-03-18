<?php
/**
 * Session Configuration File
 * This file must be included before session_start() is called
 */

// Security settings for session cookies
ini_set('session.cookie_httponly', 1); // Prevent JavaScript access to session cookie
ini_set('session.use_only_cookies', 1); // Force sessions to only use cookies
ini_set('session.cookie_secure', 0);    // Set to 1 in production with HTTPS

// Set session name
session_name('student_tournament_session');

// Set session lifetime (in seconds)
ini_set('session.gc_maxlifetime', 3600); // 1 hour
ini_set('session.cookie_lifetime', 0);   // 0 = until browser is closed

// Session garbage collection settings
ini_set('session.gc_probability', 1);
ini_set('session.gc_divisor', 100);      // 1% chance of GC running on each session start

// Session storage
ini_set('session.save_path', sys_get_temp_dir()); // Default: use system temp directory

// Only start session if it hasn't been started already
// This is a helper function that can be used elsewhere
function start_session_if_not_started() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
} 