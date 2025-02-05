<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase as LaravelTestCase;

/**
 * Feature abstract class that included database transactions functionality
 */
abstract class FeatureTestCase extends LaravelTestCase
{
    use DatabaseTransactions;
}
