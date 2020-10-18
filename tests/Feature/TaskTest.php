<?php

namespace Tests\Feature;

use App\Http\Requests\CreateTask;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    // テストケースごとにデータベースをリフレッシュしてマイグレーションを再実行する
    use RefreshDatabase;    

    /**
     * A basic feature test example.
     *
     * @return void
     * /
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    */

    // 各テストメソッド実行前に呼ばれる
    public function setUp()
    {
        parent::setUp();

        // テストケース実行前にフォルダデータを作成する
        $this->seed('FoldersTableSeeder');
    }

    /*
    * 期限日が日付でない場合はバリデーションエラー
    * @test
    */
    public function test_due_date_should_be_date()
    {
        $response = $this->post('/folders/1/tasks/create', 
                                [  'title'    => 'Sample task',
                                   'due_date' => 123,
                                ]);

        $response->assertSessionHasErrors([
            'due_date' => '期限日 には日付を入力してください。',
        ]);
    }

    /*
    *  期限日が過去の場合はバリデーションエラー
    *  @test
    */
    public function test_due_date_should_not_be_past()
    {
        $response = $this->post('/folders/1/tasks/create', 
                                [  'title'    => 'Sample task',
                                   'due_date' => Carbon::yesterday()->format('Y/m/d'),
                                ]);

        $response->assertSessionHasErrors([
            'due_date' => '期限日 には今日以降の日付を入力してください。',
        ]);
    }
}
