<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Project extends Model
{
    use HasFactory;
    protected $table = 'project';
    public $fillable = ['project_title', 'project_location', 'contractor_name', 'date_of_award', 'date_of_award', 'appropriation', 'contract_sum', 'commencement_date', 'completion_period', 'percentage_completion', 'amount_paid_till_date', 'outstanding_balance', 'certified_cv_not_paid', 'year_last_funded', 'last_funded_date', 'observations', 'challenges', 'recommendations', 'project_year', 'image_id'];
}