<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Admin\Models\Employee;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('attendences', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Employee::class)->nullable();
            $table->string('uid')->nullable();
            $table->string('userid')->nullable();
            $table->string('state')->nullable();
            $table->dateTime('timestamp')->nullable();
            $table->string('type')->nullable();
            $table->boolean('status')->nullable()->comment('0 = late_unapproved, 1 = approved');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendences');
    }
};
