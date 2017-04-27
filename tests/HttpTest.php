<?php

namespace Bench\Tests;

class HttpTest extends TestCase
{

    protected $old_index = null;
    protected $old_store = null;
    protected $old_show = null;

    public function test1()
    {
        $get_index1 = $this->json('GET', '/api/user');

        $get_show1 = $this->json('GET', '/api/user/5');

        $post_store1 = $this->json('POST', '/api/user', ['foo' => ['bar', 'baz']]);

        $post_store2 = $this->json('POST', '/api/user', ['bloop' => ['bar', 'baz']]);

        $post_store3 = $this->json('POST', '/api/user', ['foo' => ['bar', 'baz']]);

        $get_index2 = $this->json('GET', '/api/user');

        $get_show2 = $this->json('GET', '/api/user/5');

        //obviously this is not equal
        $this->assertNotEquals($get_index1->getContent(), $get_show1->getContent());

        //nor these
        $this->assertNotEquals($get_index1->getContent(), $get_show2->getContent());
        $this->assertNotEquals($get_index1->getContent(), $post_store1->getContent());
        $this->assertNotEquals($get_index1->getContent(), $post_store2->getContent());
        $this->assertNotEquals($get_index1->getContent(), $post_store3->getContent());

        // THESE ALL FAIL

        $this->assertNotEquals($get_index1->getContent(), $get_index2->getContent(), 'index1==index2: noooooooo!');
        $this->assertNotEquals($get_show1->getContent(), $get_show2->getContent(), 'show1==show2: noooooooo!');
        $this->assertNotEquals($post_store1->getContent(), $post_store3->getContent(), 'store1==store3: noooooooo!');
        $this->assertNotEquals($post_store1->getContent(), $post_store2->getContent(), 'store1==store2: noooooooo!');

        // THESE ALL FAIL
    }

    //use this test to save values
    public function test2()
    {
        $this->old_index = $this->json('GET', '/api/user')->getContent();

        $this->old_show = $this->json('GET', '/api/user/5')->getContent();

        $this->old_store = $this->json('POST', '/api/user', ['foo' => ['bar', 'baz']])->getContent();
    }

    //assert they are different between tests, so we DO clean up between these...
    public function test3()
    {
        $index = $this->json('GET', '/api/user')->getContent();

        $show = $this->json('GET', '/api/user/5')->getContent();

        $store = $this->json('POST', '/api/user', ['foo' => ['bar', 'baz']])->getContent();

        // we all pass!
        $this->assertNotEquals($this->old_store, $store);
        $this->assertNotEquals($this->old_show, $show);
        $this->assertNotEquals($this->old_index, $index);
    }
}
