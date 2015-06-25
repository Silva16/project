<?php namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests;
use App\Project;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('author.editor.project', ['except' => ['create', 'store']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id)
    {
        $user = Auth::user();
        $approved_by = [];
        $user_name = [];

        $filter_array = array('All' => 'all', 'Refused' => '0', 'Approved' => '1', 'Pending' => '2');
        $sort_array = array('Updated' => 'updated_at');
        $order_array = array('Ascendant' => 'asc', 'Descendant' => 'desc');

        if (($sort = Input::get('sort')) != null && ($order = Input::get('order')) != null && ($filter = Input::get('filter')) != null) {

            $comments = $this->getComment($id, $sort_array[Input::get('sort')], $order_array[Input::get('order')],
                $filter_array[Input::get('filter')]);
        } else {

            $comments = $this->getComment($id);
            $sort = 'Created';
            $order = 'Descendant';
            $filter = 'All';
        }

        $project = Project::find($id);

        foreach ($comments as $comment) {

            if ($comment->user_id != null) {
                $user_name[$comment->id] = User::find($comment->user_id)->name;
            }
            if ($comment->approved_by != null) {
                $approved_by[$comment->id] = User::find($comment->approved_by)->name;
            }
        }

        return view('comments.list',
            compact('comments', 'project', 'user_name', 'approved_by', 'sort', 'order', 'filter', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($id)
    {
        return view('comments.create', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store($id)
    {
        $comment = new Comment();

        $date = new \DateTime();
        $comment->project_id = $id;
        $comment->comment = Input::get('comment');
        $comment->created_at = $date->getTimestamp();
        $comment->updated_at = $date->getTimestamp();

        if (Auth::check()) {
            $comment->user_name = Auth::user()->name;
            $comment->user_id = Auth::user()->id;
        }
        if (Auth::check() && Auth::user()->role == 2) {
            $comment->approved_by = Auth::user()->id;
            $comment->state = 1;
        } else {
            $comment->state = 2;
        }


        $comment->save();

        return redirect('projects/' . $id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    private function getComment($id, $sort = 'created_at', $order = 'desc', $filter = 'all')
    {

        if ($filter != 'all') {
            $comments = Comment::where('project_id', '=', $id)->where('state', '=', $filter)->orderBy($sort,
                $order)->get();

        } else {
            $comments = Comment::where('project_id', '=', $id)->orderBy($sort, $order)->get();
        }

        return $comments;
    }

    public function approve($id)
    {

        $comment = Comment::find($id);
        $state = '1';
        $this->editState($comment, $state);

        return redirect('comments/index/' . $comment->project_id);
    }

    public function refuse($id)
    {

        $comment = Comment::find($id);

        return view('comments.refusal', compact('comment'));
    }

    public function refuseMessage($id)
    {

        $comment = Comment::find($id);
        $state = '0';
        $message = Input::get('message');
        $this->editState($comment, $state, $message);


        return redirect('comments/index/' . $comment->project_id);
    }

    private function editState($comment, $state, $message = null)
    {

        if ($state == 1) {
            $comment->state = $state;
            $comment->approved_by = Auth::user()->id;
        } elseif ($state == 0) {
            $comment->refusal_msg = $message;
            $comment->state = $state;
        }

        $comment->save();
    }
}
