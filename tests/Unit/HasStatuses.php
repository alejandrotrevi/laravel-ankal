<?php

namespace Alejandrotrevi\LaravelAnkal\Tests\Unit;

use Alejandrotrevi\LaravelAnkal\Models\TestModel;
use Alejandrotrevi\LaravelAnkal\Tests\TestCase;
use Illuminate\Foundation\Inspiring;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HasStatuses extends TestCase
{
    use RefreshDatabase;

    /**
     * @var \Alejandrotrevi\LaravelAnkal\Models\TestModel
     */
    public $model;

    public function setUp(): void
    {
        parent::setUp();

        $this->model = TestModel::create([
           'name' =>  Inspiring::quote()
        ]);
    }

    public function test_can_set_status()
    {
        $this->assertTrue($this->model->setStatus('new-status'));

        $this->assertDatabaseHas('test_models', [
            'status' => 'new-status'
        ]);
    }

    public function test_can_set_reason()
    {
        $this->assertTrue($this->model->setStatus('new-status', 'my reason'));

        $this->assertDatabaseHas('test_models', [
            'status' => 'new-status',
            'reason' => 'my reason'
        ]);
    }

    public function test_date_changes_when_new_status_is_set()
    {
        $currentDate = $this->model->status_updated_at;

        $this->model->setStatus('new-status');
        $this->assertNotEquals($currentDate, $this->model->status_updated_at);
    }

    public function test_current_status_scope_filters_correctly()
    {
        $newModel = TestModel::create([
            'name' =>  'new-test-model'
        ]);

        $this->model->setStatus('new-status');

        $this->assertCount(1, TestModel::currentStatus('new-status')->get());

        $newModel->setStatus('new-status');

        $this->assertCount(2, TestModel::currentStatus('new-status')->get());
    }

    public function test_except_status_scope_filters_correctly()
    {
        TestModel::create([
            'name' =>  'new-test-model'
        ]);

        $this->model->setStatus('new-status');

        $elements = TestModel::exceptStatus('new-status')->get();

        $this->assertCount(1, $elements);
        $this->assertEquals('default', $elements->first()->status);
    }
}