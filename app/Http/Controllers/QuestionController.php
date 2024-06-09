<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    public $paginationLength;
    public $model;
    public $viewDirectory = 'questions';
    public $route = 'question';

    public function __construct(Question $model)
    {
        $this->middleware('auth');

        $this->paginationLength = config('constants.pagination_length');
        $this->model = $model;

    }

    public function index(Request $request)
    {

        $questions = $this->model->paginate($this->paginationLength);

        return view($this->viewDirectory . '.index', compact('questions', 'request'));

    }
    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'sending_date' => 'required|date|date_format:Y-m-d',
            'status' => 'required|in:0,1',
            'is_used' => 'required|in:0,1',
        ]);

        $question = $this->model->findOrFail($id);

        try {
            DB::beginTransaction();
            $question->update([
                'sending_date' => $request->sending_date,
                'status' => $request->status,
                'is_used' => $request->is_used,
            ]);

            DB::commit();
            return redirect()->route($this->route . '.index')->with('success', 'Question Updated Successfully!');
        } catch (\Exception $exception) {
            DB::rollback();

            $this->model->writeExceptionMessage($exception);
            return \redirect()->back()->with('error', 'Question update Failed!!');
        }

    }

}
