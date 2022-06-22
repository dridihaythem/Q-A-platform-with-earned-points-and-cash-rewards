<?php

use App\Models\PaymentMethod;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdraw_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(PaymentMethod::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->float('amount', 8, 2)->default(0);
            $table->enum('status', ['pending', 'approved', 'rejected']);
            $table->longText('payment_details')->nullable();
            $table->longText('status_details')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('withdraw_requests');
    }
};
