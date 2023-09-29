<?php

namespace App\Enums;

enum LeadLossReasonEnum:string {
    case NotAFit = 'not-a-fit';
    case Price = 'price';
    case WentWithCompetitor = 'went-with-competitor';
}