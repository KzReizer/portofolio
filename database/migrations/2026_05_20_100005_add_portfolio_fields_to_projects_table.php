<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            if (! Schema::hasColumn('projects', 'name')) {
                $table->string('name')->after('id');
            }

            if (! Schema::hasColumn('projects', 'description')) {
                $table->text('description')->nullable()->after('name');
            }

            if (! Schema::hasColumn('projects', 'tech_stack')) {
                $table->string('tech_stack')->nullable()->after('description');
            }

            if (! Schema::hasColumn('projects', 'link')) {
                $table->string('link')->nullable()->after('tech_stack');
            }

            if (! Schema::hasColumn('projects', 'image_path')) {
                $table->string('image_path')->nullable()->after('link');
            }

            if (! Schema::hasColumn('projects', 'sort_order')) {
                $table->unsignedInteger('sort_order')->default(0)->after('image_path');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $columns = ['name', 'description', 'tech_stack', 'link', 'image_path', 'sort_order'];

            foreach ($columns as $column) {
                if (Schema::hasColumn('projects', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
