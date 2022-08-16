<?php

namespace App\Modules\Admin\Lead\Controllers\Api;

use App\Modules\Admin\Lead\Models\Lead;
use App\Modules\Admin\Lead\Requests\LeadCreateRequest;
use App\Modules\Admin\Lead\Services\LeadService;
use App\Services\Responses\ResponseService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LeadController extends Controller
{
  private $service;

  public function __construct(LeadService $leadService)
  {
    $this->service = $leadService;
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function index()
  {
    $this->authorize('view', Lead::class);

    $result = $this->service->getLeads();

    return ResponseService::sendJsonResponse(true, 200, [], [
      'items' => $result
    ]);
  }

  /**
   * Create of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function store(LeadCreateRequest $request)
  {
    $this->authorize('create', Lead::class);
    $lead = $this->service->store($request, Auth::user());

    return ResponseService::sendJsonResponse(true, 200, [], [
      'item' => $lead
    ]);
  }

  /**
   * Display the specified resource.
   *
   * @param \App\Modules\Admin\Lead\Models\Lead $lead
   * @return \Illuminate\Http\JsonResponse
   */
  public function show(Lead $lead)
  {
    $this->authorize('view', Lead::class);
    return ResponseService::sendJsonResponse(true, 200, [], [
      'item' => $lead
    ]);
  }

  /**
   * Display the specified resource.
   *
   * @param \App\Modules\Admin\Lead\Models\Lead $lead
   * @return \Illuminate\Http\Response
   */
  public function edit(Lead $lead)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param \App\Modules\Admin\Lead\Models\Lead $lead
   * @return \Illuminate\Http\JsonResponse
   */
  public function update(LeadCreateRequest $request, Lead $lead)
  {
    $this->authorize('edit', Lead::class);
    $lead = $this->service->update($request, Auth::user(), $lead);

    return ResponseService::sendJsonResponse(true, 200, [], [
      'item' => $lead
    ]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param \App\Modules\Admin\Lead\Models\Lead $lead
   * @return \Illuminate\Http\Response
   */
  public function destroy(Lead $lead)
  {
    //
  }

  public function archive(): \Illuminate\Http\JsonResponse
  {
    $this->authorize('view', Lead::class);
    $leads = $this->service->archive();

    return ResponseService::sendJsonResponse(true, 200, [], [
      'items' => $leads
    ]);
  }

  /**
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   * @throws \Illuminate\Auth\Access\AuthorizationException
   */
  public function checkExist(Request $request)
  {
    $this->authorize('create', Lead::class);
    $lead = $this->service->checkExist($request);

    if ($lead) {
      return ResponseService::sendJsonResponse(true, 200, [], [
        'item' => $lead,
        'exist' => true
      ]);
    }

    return ResponseService::success();
  }

  /**
   * @param Request $request
   * @param Lead $lead
   * @return \Illuminate\Http\JsonResponse
   * @throws \Illuminate\Auth\Access\AuthorizationException
   */
  public function updateQuality(Request $request, Lead $lead)
  {
    $this->authorize('edit', Lead::class);
    $lead = $this->service->updateQuality($request, $lead);

    return ResponseService::sendJsonResponse(true, 200, [], [
      'item' => $lead,
    ]);
  }
}
