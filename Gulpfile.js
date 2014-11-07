var elixir = require('./vendor/laravel/elixir/Elixir');

/*
 |----------------------------------------------------------------
 | Have a Drink!
 |----------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic
 | Gulp tasks for your Laravel application. Elixir supports
 | several common CSS, JavaScript and even testing tools!
 |
 */

elixir(function(mix) {
    mix.sass(['styles.scss'])
       .styles(['css/styles.css', 'css/grid.css'])
       .scripts(['assets/js/jquery.timediff.min.js', 'assets/js/time-circles.js', 'assets/js/app.js'])
       .version(['css/all.min.css', 'js/all.min.js']);
});
