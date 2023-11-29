<?php

namespace App\Http\Controllers;

use App\Entities\User;
use App\Entities\Message;
use LMS\Modules\Courses\Repositories\Contracts\CourseRepositoryInterface;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('messages');
    }

    /**
     * Show the application dashboard.
     *
     * @param CourseRepositoryInterface $courseRepository
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(CourseRepositoryInterface $courseRepository)
    {
        $courses = $courseRepository->allAvailable();

        return view('dashboard', compact('courses'));
    }

    /**
     * Show bahan ajar and chat
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function bahan_ajar()
    {
        return view('bahan_ajar');
    }

}
