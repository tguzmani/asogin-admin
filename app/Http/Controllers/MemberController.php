<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sortField = $request->input('sortField', 'id');
        $sortDirection = $request->input('sortDirection', 'asc');
        $perPage = $request->input('perPage', 10);

        // Ensure sortDirection is either 'asc' or 'desc'
        $sortDirection = in_array(strtolower($sortDirection), ['asc', 'desc']) ? $sortDirection : 'asc';

        $members = Member::query()
            ->when($search, function ($query, $search) {
                $query->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->orderBy($sortField, $sortDirection) // Apply validated sorting
            ->paginate($perPage);

        return inertia('Members/Index', [
            'members' => $members,
            'filters' => $request->only('search'),
        ]);
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Members/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMemberRequest $request)
    {
        Member::create($request->validated());

        return redirect()->route('members.index')->with('success', 'Miembro creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Fetch the member by ID
        $member = Member::with('memberships')->findOrFail($id);


        $latestMembership = $member->memberships->sortByDesc('start_date')->first();

        // Append the latest membership to the member object
        $member->membership = $latestMembership;

        // Return the data to the Vue component via Inertia
        return inertia('Members/Show', [
            'member' => $member,
        ]);

        // Return the data to the Vue component via Inertia
        return inertia('Members/Show', [
            'member' => $member,
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMemberRequest $request, Member $member)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        //
    }
}
