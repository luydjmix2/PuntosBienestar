<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wellness_events_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('wellness_event_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('wellness_event_id')->references('id')->on('wellness_events')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        // Define el disparador después de crear la tabla
        DB::unprepared('
            CREATE TRIGGER event_user_points_after_insert
            AFTER INSERT ON wellness_events_user
            FOR EACH ROW
            BEGIN
                DECLARE user_points INT;
                DECLARE event_points INT;

                -- Obtener los puntos acumulados del usuario desde la tabla wellness_points
                SELECT puntos_acumulados INTO user_points FROM wellness_points WHERE user_id = NEW.user_id;

                -- Obtener los puntos del evento desde la tabla wellness_events
                SELECT points INTO event_points FROM wellness_events WHERE id = NEW.wellness_event_id;

                -- Actualizar los puntos acumulados del usuario sumando los puntos del evento
                UPDATE wellness_points SET puntos_acumulados = user_points + event_points WHERE user_id = NEW.user_id;
            END;
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wellness_events_user');

        // Elimina el procedimiento almacenado cuando se revierte la migración
        DB::unprepared('DROP PROCEDURE IF EXISTS event_user_points_after_insert');
    }
};
