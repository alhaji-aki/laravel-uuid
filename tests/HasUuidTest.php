<?php

namespace AlhajiAki\LaravelUuid\Tests;

use Illuminate\Support\Str;

class HasUuidTest extends TestCase
{
    /** @test */
    public function it_will_save_a_uuid_when_saving_a_model()
    {
        $model = TestModel::create(['name' => 'this is a test']);

        $this->assertTrue(Str::isUuid((string) $model->uuid));
    }

    /** @test */
    public function it_will_not_change_the_uuid_when_updating_the_model()
    {
        $model = TestModel::create(['name' => 'this is a test']);

        $model->other_field = 'otherValue';
        $model->save();

        $this->assertEquals((string) $model->uuid, $model->fresh()->uuid);
    }

    /** @test */
    public function it_will_save_a_unique_uuid_always()
    {
        // create a model, then create another with the same uuid
        $myModel = TestModel::create(['name' => 'this is a test']);

        $mySecondModel = TestModel::create([
            'uuid' => $myModel->uuid,
            'name' => 'this is a test'
        ]);

        $this->assertNotEquals($myModel->uuid, $mySecondModel->uuid);
    }

    /** @test */
    public function it_will_save_a_unique_slug_by_default_even_when_soft_deletes_are_on()
    {
        TestModelSoftDeletes::create(['name' => 'this is a test', 'deleted_at' => date('Y-m-d h:i:s')]);

        foreach (range(1, 10) as $i) {
            $model = TestModelSoftDeletes::create(['name' => 'this is a test']);

            $this->assertEquals(1, TestModelSoftDeletes::where('uuid', $model->uuid)->count());
        }
    }
}
