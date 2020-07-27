<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Faq;
use Validator;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['faqs'] = Faq::select('id', 'question', 'status')->get();
        return view('admin.faq.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.faq.createfaq');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'question' => 'required',
            'answer' => 'required',
            'status' => 'required'

        ]);
       
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $faqObj = new Faq();
        $faqObj->question = $request->question;
        $faqObj->answer = $request->answer;
        $faqObj->status = $request->status;
        $faqObj->save();
        return redirect()->route('faq.index')->with('success', 'FAQ Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['faq'] = Faq::find($id);
        return view('admin.faq.detailsfaq', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['faq'] = Faq::find($id);
        return view('admin.faq.editfaq', $data);
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
        $validator = Validator::make($request->all(),[
            'question' => 'required',
            'answer' => 'required',
            'status' => 'required'

        ]);
       
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $faqObj = Faq::find($id);
        $faqObj->question = $request->question;
        $faqObj->answer = $request->answer;
        $faqObj->status = $request->status;
        $faqObj->save();
        return redirect()->route('faq.index')->with('success', 'FAQ Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Faq::find($id)->delete();
        return redirect()->route('faq.index')->with('success', 'FAQ Deleted Successfully');
    }
}
