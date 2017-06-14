<?php



class ExampleTest extends FeatureTestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {

        $user = factory(\App\User::class)->create([
            'name'  => 'Laravel Test',
            'email' => 'admin@gmail.com',
        ]);

        $this->actingAs($user, 'api')
            ->visit('api/user')
            ->see('Laravel Test')
            ->see('admin@gmail.com');
    }
}
