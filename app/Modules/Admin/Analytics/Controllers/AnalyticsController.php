<?php

namespace App\Modules\Admin\Analytics\Controllers;

use App\Modules\Admin\Analytics\Export\LeadsExport;
use App\Modules\Admin\Analytics\Models\Analytic;
use App\Modules\Admin\User\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Excel;

class AnalyticsController extends Controller
{
  public function export(User $user, $dateStart, $dateEnd)
  {
    $export = new LeadsExport($user, $dateStart, $dateEnd);
    return Excel::download($export, 'leads.xlsx');
  }
}
