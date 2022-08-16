<?php

namespace App\Modules\Admin\Role\Controllers;

use App\Modules\Admin\Dashboard\Classes\Base;
use App\Modules\Admin\Role\Models\Role;
use App\Modules\Admin\Role\Requests\RoleRequest;
use App\Modules\Admin\Role\Services\RoleService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class RoleController extends Base
{

    public function __construct(RoleService $roleService)
    {
        parent::__construct();
        $this->service = $roleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view', Role::class);
        $roles = Role::all();

        $this->title = 'Roles Module';
        $this->content = view('Admin::Role.index')
            ->with([
                'roles' => $roles,
                'title' => $this->title
            ])
            ->render();

        return $this->renderOutput();
    }

    /**
     * Create of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Role::class);


        $this->title = 'Roles Module | Create';
        $this->content = view('Admin::Role.create')
            ->with([
                'title' => $this->title
            ])
            ->render();

        return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RoleRequest $request)
    {
        $this->service->save($request, new Role());
        return redirect()->route('roles.index')->with([
            'message' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Modules\Admin\Role\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Modules\Admin\Role\Models\Role  $role
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $this->authorize('edit', Role::class);


        $this->title = 'Roles Module | Edit';
        $this->content = view('Admin::Role.edit')
            ->with([
                'title' => $this->title,
                'item' => $role
            ])
            ->render();

        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Modules\Admin\Role\Models\Role  $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(RoleRequest $request, Role $role)
    {
        $this->service->save($request, $role);
        return redirect()->route('roles.index')->with([
            'message' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Modules\Admin\Role\Models\Role  $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with([
            'message' => 'success'
        ]);
    }
}
