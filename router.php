<?php
/*
 * Register routes here.
 */

route_get('', 'DocumentReviewController@showForm');

route_post('process/file', 'DocumentReviewController@processFile');

route_post('process/pdf', 'DocumentReviewController@processPDF');