<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ViewResume extends Migration
{
    public function up()
    {
        $this->db->query("CREATE VIEW travel_etape AS
    SELECT 
        t.id AS travel_id,
        t.id_user AS user_id,
        t.id_car AS car_id,
        t.nb_seat AS total_seat,
        t.comment AS travel_comment,

        -- Informations sur la voiture (jointe via id_car)
        c.id_user AS car_owner_id,  -- L'utilisateur associé à la voiture

        -- Jointure avec la table modelcar pour obtenir le nom du modèle
        mc.name AS car_model_name,  -- Remplacement de car_model_id par le nom du modèle

        -- Jointure avec la table color pour obtenir le nom de la couleur
        col.name AS car_color,  -- Remplacement de car_color par le nom dans la table color
        
        -- Informations sur l'étape de départ (order = 1)
        (SELECT e.adress_departure 
         FROM etape e 
         WHERE e.id_travel = t.id AND e.order = 1 
         LIMIT 1) AS departure_address,
         
         (SELECT e.id 
         FROM etape e 
         WHERE e.id_travel = t.id AND e.order = 1 
         LIMIT 1) AS id_etape_departure,
         
         (SELECT e.id_city_departure 
         FROM etape e 
         WHERE e.id_travel = t.id AND e.order = 1 
         LIMIT 1) AS id_city_departure,
         
        (SELECT e.date_departure 
         FROM etape e 
         WHERE e.id_travel = t.id AND e.order = 1 
         LIMIT 1) AS departure_date,
         
        (SELECT e.nb_seat 
         FROM etape e 
         WHERE e.id_travel = t.id AND e.order = 1 
         LIMIT 1) AS departure_seat,
         
        (SELECT e.order
         FROM etape e 
         WHERE e.id_travel = t.id AND e.order = 1 
         LIMIT 1) AS departure_order,

        -- Informations sur l'étape d'arrivée (order = 2)
        (SELECT e.adress_departure 
         FROM etape e 
         WHERE e.id_travel = t.id AND e.order = 2 
         LIMIT 1) AS arrival_address,
         
         (SELECT e.id_city_departure 
         FROM etape e 
         WHERE e.id_travel = t.id AND e.order = 2 
         LIMIT 1) AS id_city_arrival,
         
         (SELECT e.id 
         FROM etape e 
         WHERE e.id_travel = t.id AND e.order = 2 
         LIMIT 1) AS id_etape_arrival,
         
        (SELECT e.date_departure 
         FROM etape e 
         WHERE e.id_travel = t.id AND e.order = 2 
         LIMIT 1) AS arrival_date,
         
        (SELECT e.nb_seat 
         FROM etape e 
         WHERE e.id_travel = t.id AND e.order = 2 
         LIMIT 1) AS arrival_seat,

        (SELECT e.order 
         FROM etape e 
         WHERE e.id_travel = t.id AND e.order = 2 
         LIMIT 1) AS arrival_order,

        -- Jointure avec la table city pour obtenir les labels des villes de départ et d'arrivée
        -- Ville de départ (order = 1)
        (SELECT ci.label
         FROM etape e 
         JOIN city ci ON e.id_city_departure = ci.id
         WHERE e.id_travel = t.id AND e.order = 1 
         LIMIT 1) AS departure_city_label,    
      
         
         (SELECT ci.zip_code
         FROM etape e 
         JOIN city ci ON e.id_city_departure = ci.id
         WHERE e.id_travel = t.id AND e.order = 1 
         LIMIT 1) AS zip_code_departure,

        -- Ville d'arrivée (order = 2)
        (SELECT ci.label 
         FROM etape e 
         JOIN city ci ON e.id_city_departure = ci.id
         WHERE e.id_travel = t.id AND e.order = 2 
         LIMIT 1) AS arrival_city_label,

        (SELECT ci.zip_code 
         FROM etape e 
         JOIN city ci ON e.id_city_departure = ci.id
         WHERE e.id_travel = t.id AND e.order = 2 
         LIMIT 1) AS zip_code_arrival,

        -- Department number pour la ville de départ
        (SELECT ci.department_number 
         FROM etape e 
         JOIN city ci ON e.id_city_departure = ci.id
         WHERE e.id_travel = t.id AND e.order = 1 
         LIMIT 1) AS departure_department_number,

        -- Department number pour la ville d'arrivée
        (SELECT ci.department_number 
         FROM etape e 
         JOIN city ci ON e.id_city_departure = ci.id
         WHERE e.id_travel = t.id AND e.order = 2 
         LIMIT 1) AS arrival_department_number,

        -- Ajout des informations sur l'utilisateur
        u.last_name AS user_last_name,
        u.username AS user_username

    FROM 
        travel t
    -- Jointure avec la table car
    LEFT JOIN car c ON t.id_car = c.id
    -- Jointure avec la table color pour obtenir le nom de la couleur
    LEFT JOIN color col ON c.id_color = col.id
    -- Jointure avec la table modelcar pour obtenir le nom du modèle
    LEFT JOIN modelcar mc ON c.id_modelcar = mc.id
    -- Jointure avec la table user pour récupérer le last_name et le username
    LEFT JOIN user u ON t.id_user = u.id;
    ");
    }

    public function down()
    {
        $this->db->query("DROP VIEW IF EXISTS travel_etape;");
    }
}
