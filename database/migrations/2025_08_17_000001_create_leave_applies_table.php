<?php

use App\Models\Admin;
use App\Models\LeaveType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Admin\Models\Employee;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leave_applies', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Employee::class)->nullable();
            $table->foreignIdFor(LeaveType::class)->nullable();
            $table->date('from_date');
            $table->date('to_date');
            $table->integer('total_date');
            $table->text('note')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->unsignedBigInteger('apply_by')->nullable();
            $table->unsignedBigInteger('approve_by')->nullable();
            $table->date('approved_date')->nullable();
            $table->timestamps();

        });

        Schema::table('employees', function (Blueprint $table) {
            $table->tinyInteger('status')->default(1);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leave_applies');
    }
};
