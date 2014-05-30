<?php

View::composer('*', 'GlobalComposer');
View::composer(array('partials.nav'), 'NavigationComposer');