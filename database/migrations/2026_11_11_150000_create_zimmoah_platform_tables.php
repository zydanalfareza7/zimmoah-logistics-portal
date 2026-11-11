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
        // 1. Office Branches Directory
        Schema::create('offices', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->text('address');
            $table->string('city');
            $table->string('phone');
            $table->string('fax')->nullable();
            $table->string('email');
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->boolean('is_headquarters')->default(false);
            $table->timestamps();
        });

        // 2. Shipping & Freight Schedules
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('transport_mode')->default('SEA'); // SEA, AIR, ROAD
            $table->string('origin_port');
            $table->string('destination_port');
            $table->string('carrier_vessel_name');
            $table->string('voyage_number')->nullable();
            $table->dateTime('departure_time');
            $table->dateTime('arrival_time');
            $table->dateTime('cut_off_time')->nullable();
            $table->string('status')->default('SCHEDULED'); // SCHEDULED, IN_TRANSIT, DELAYED, COMPLETED
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // 3. Operational Advisories & Announcements (Maersk style)
        Schema::create('advisories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category')->default('OPERATIONAL'); // OPERATIONAL, WEATHER, HOLIDAY, REGULATORY
            $table->text('summary');
            $table->longText('content')->nullable();
            $table->string('action_text')->default('Read updates');
            $table->string('action_url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });

        // 4. Email Ticketing System
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_code')->unique(); // e.g. ZIM-2026-XXXXX
            $table->string('access_token', 64)->unique(); // tokenized secure tracking without requiring login
            $table->string('customer_name');
            $table->string('customer_email')->index();
            $table->string('customer_phone')->nullable();
            $table->string('subject');
            $table->string('category')->default('GENERAL'); // FORWARDING, TRUCKING, WAREHOUSING, BILLING, GENERAL
            $table->string('priority')->default('MEDIUM'); // LOW, MEDIUM, HIGH, URGENT
            $table->string('status')->default('NEW'); // NEW, OPEN, PENDING, RESOLVED, CLOSED
            $table->foreignId('assigned_agent_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('sla_due_at')->nullable();
            $table->timestamp('first_responded_at')->nullable();
            $table->timestamp('resolved_at')->nullable();
            $table->timestamps();
        });

        Schema::create('ticket_replies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_id')->constrained('tickets')->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete(); // null if sent by customer
            $table->string('sender_name');
            $table->string('sender_email');
            $table->string('sender_type')->default('CUSTOMER'); // CUSTOMER, AGENT, SYSTEM
            $table->string('message_id')->nullable()->index(); // RFC Message-ID for email threading
            $table->longText('body_html')->nullable();
            $table->longText('body_text');
            $table->boolean('is_internal_note')->default(false);
            $table->timestamps();
        });

        Schema::create('ticket_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_id')->constrained('tickets')->cascadeOnDelete();
            $table->foreignId('ticket_reply_id')->nullable()->constrained('ticket_replies')->cascadeOnDelete();
            $table->string('file_name');
            $table->string('file_path');
            $table->unsignedBigInteger('file_size');
            $table->string('mime_type');
            $table->timestamps();
        });

        // 5. Career & Recruitment ATS
        Schema::create('job_postings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('office_id')->constrained('offices')->cascadeOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('department'); // Operations, Sales, Logistics, Warehousing, IT, HR & Finance
            $table->string('employment_type')->default('FULL_TIME'); // FULL_TIME, CONTRACT, INTERNSHIP
            $table->string('experience_level')->default('MID'); // ENTRY, MID, SENIOR, LEAD
            $table->string('salary_range')->nullable();
            $table->text('description');
            $table->longText('responsibilities');
            $table->longText('requirements');
            $table->longText('benefits')->nullable();
            $table->boolean('is_active')->default(true);
            $table->date('deadline')->nullable();
            $table->timestamps();
        });

        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_posting_id')->constrained('job_postings')->cascadeOnDelete();
            $table->string('full_name');
            $table->string('email')->index();
            $table->string('phone');
            $table->string('linkedin_url')->nullable();
            $table->string('resume_path');
            $table->string('resume_original_name');
            $table->decimal('expected_salary', 14, 2)->nullable();
            $table->string('notice_period')->nullable();
            $table->text('cover_letter')->nullable();
            $table->string('stage')->default('NEW'); // NEW, SCREENING, INTERVIEW, OFFER, HIRED, REJECTED
            $table->unsignedTinyInteger('rating')->default(0); // 0-5 stars
            $table->timestamps();
        });

        Schema::create('application_notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_application_id')->constrained('job_applications')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->text('note');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_notes');
        Schema::dropIfExists('job_applications');
        Schema::dropIfExists('job_postings');
        Schema::dropIfExists('ticket_attachments');
        Schema::dropIfExists('ticket_replies');
        Schema::dropIfExists('tickets');
        Schema::dropIfExists('advisories');
        Schema::dropIfExists('schedules');
        Schema::dropIfExists('offices');
    }
};
