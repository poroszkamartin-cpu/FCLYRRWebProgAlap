$(document).ready(function () {

    $("#load_data").click(function () {

        $("#area").html("");
        $("#area").append("<h2>TOKAJ HEGYALJA EGYETEM</h2>");

        // Mi a JSON fájl neve? Ez legyen pontosan ugyanaz a fájlnév a mappában:
        var jsonFile = "PM_orarendfull.json";

        console.log("Kezdem a getJSON kérést: ", jsonFile);

        $.getJSON(jsonFile, function (data) {

            console.log("JSON bejött:", data);

            // Cím
            $("#area").append("<b>Cím</b><br>");
            $("#area").append(data.cim.iranyitoszam + " " + data.cim.varos + ", " + data.cim.utca + "<br><br>");

            // Telefonszámok
            $("#area").append("<b>Telefonszámok:</b><br><ul>");

            for (let i = 0; i < data.telefonszam.length; i++) {
                $("#area").append(
                    "<li>" +
                    data.telefonszam[i].tipus +
                    ":&nbsp;" +
                    data.telefonszam[i].szam +
                    "</li>"
                );
            }

            $("#area").append("</ul><br><b>THE, PTI Órarend 2025 ősz</b><br><br>");

            // Órarend
            for (let i = 0; i < data.ora.length; i++) {

                $("#area").append("<b>Tárgy:</b>&nbsp;" + data.ora[i].targy + "<br><br>");

                $("#area").append("<b>Időpont:</b><br>&nbsp;Nap:&nbsp;" +
                    data.ora[i].idopont.nap +
                    "<br>&nbsp;Tól:&nbsp;" +
                    data.ora[i].idopont.tol +
                    "<br>&nbsp;Ig:&nbsp;" +
                    data.ora[i].idopont.ig +
                    "<br><br>"
                );

                $("#area").append("<b>Helyszín:</b>&nbsp;" + data.ora[i].helyszin + "<br><br>");

                $("#area").append("<b>Oktató:</b>&nbsp;" + data.ora[i].oktato + "<br><br>");

                $("#area").append("<b>Szak:</b>&nbsp;" + data.ora[i].szak + "<br><br>");

                if (data.ora[i].tipus) {
                    $("#area").append("<b>Típus:</b>&nbsp;" + data.ora[i].tipus + "<br><br>");
                }

                $("#area").append("<hr>");
            }
        })
        .fail(function(jqxhr, textStatus, error) {
            var err = textStatus + ", " + error;
            console.error("getJSON hiba: " + err);
            $("#area").html("<p style='color:red;'>Hiba a JSON betöltésekor: " + err + "</p>" +
                            "<p>Nyisd meg a Konzolt (F12) és nézd meg a Network fül alatt a választ.</p>");
        });
    });
});
