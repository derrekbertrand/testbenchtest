<?php

namespace Bench\Tests\Controllers;

use Illuminate\Http\Request;


/**
 * Every time this is initialized, we wait a second and get the timestamp.
 * If it, indeed, does instantiate each time, then no two requests would
 * have the same timestamp. If we are getting the same timestamps, then
 * data is not being cleared between requests the way a real world app
 * would.
 */
class UserController extends Controller
{
    public function __construct()
    {
        //each instance will have a different timestamp now
        sleep(1);

        $this->text = (new \DateTime('@'.time()))->format('Y-m-d H:i:s');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response(__METHOD__.'@'.$this->text);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return response(__METHOD__.'@'.$this->text);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return response(__METHOD__.'@'.$this->text);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return response(__METHOD__.'@'.$this->text);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        return response(__METHOD__.'@'.$this->text);
    }
}
