<?php

namespace App\Http\Controllers;

use App\Models\Point;
use Illuminate\Http\Request;

class PointController extends Controller
{

    /**
     * Lists all points.
     *
     * @return View
     */
    public function index()
    {
        return view('welcome', ['points' => Point::all()]);
    }

    /**
     * Displays form to add new point.
     *
     * @return View
     */
    public function add()
    {
        return view('point.add');
    }

    /**
     * Stores a new point.
     *
     * @return Request
     */
    public function store()
    {
        Point::create(request()->except('_token'));

        return redirect('/')
                ->with('status', "Point '" . request()->name . "' was added!");
    }

    /**
     * Displays details of a point.
     *
     * @param integer $id
     * @return View
     */
    public function show($id)
    {
        return view('point.show', [
                                    'point' => Point::where('id', $id)->first()
                                ]
                            );
    }

    /**
     * Updates point data.
     *
     * @param integer $id
     * @return Redirect
     */
    public function update($id)
    {
        if (request()->has('delete_btn')){
            Point::destroy($id);

            return redirect('/')
                ->with('status', "Point '" . request()->name . "' was deleted!");
        }

        Point::where('id', $id)
                ->first()
                ->update(request()->only(['name', 'x', 'y']));

        return redirect('/')
                ->with('status', "Point '" . request()->name . "' was updated!");
    }

    public function siblings()
    {
        // Current point
        $point_id =  request()->post('id');

        // New points
        $new_px = request()->post('px');
        $new_py = request()->post('py');

        // All points
        $siblings = Point::where('id', '!=', $point_id)->get();
        $sibling_collection = collect();

        foreach ($siblings as $p) {
            $d = round(sqrt(pow($p->x - $new_px, 2) * pow($p->y - $new_py, 2)), 4);

            $sibling_collection->push([
                                    'd' => $d,
                                    'tr' => sprintf('<tr><td>%s(%s, %s)</td></tr>', $p->name, $p->x, $p->y)
                                ]);
        }

        $sorted =  $sibling_collection->sortBy([
                    ['d', 'asc']
                ])
                // ->take(3)
                ->values()
                ->all();

        $nearest = '';
        $farthest = '';
        $farthest_pos = count($sorted)-1;

        for ($i=0; $i < count($sorted); $i++) {
            $nearest .= $sorted[$i]['tr'];
            $farthest .= $sorted[$farthest_pos]['tr'];
            $farthest_pos--;
        }

        return [
            'nearest' => $nearest,
            'farthest' => $farthest,
        ];
    }
}
