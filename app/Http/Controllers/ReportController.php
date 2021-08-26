<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Repository\ReportRepository;
use App\Helper\ResponseHelper;

class ReportController extends Controller
{
    private $reportRepo;
    private $helping;

    public function __construct(){
        $this->reportRepo = new ReportRepository();
        $this->helping = new ResponseHelper();
    }
    public function report(): JsonResponse{
        return response()->json($this->helping->indexData($this->reportRepo->reportRepository(), "Most attractive data."));
    }

    public function thirdHighest($receiverId): JsonResponse{
        return response()->json($this->helping->indexData($this->reportRepo->thirdHighestRepository($receiverId), "Third highest conversion amount for a particular receiver."));
    }
}
