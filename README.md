# Välkommen till MVC kursen

![Profilbild](profilbild_fb.jpg)

Hej och välkommen till MVC kursen,där vi ska komma igång med webbplatsen och hur vi kan klona kurs repot.

# Komma igång

För att vi ska kunna köra igång behöver vi se till att ha dessa följade installerade:

-PHP (version 8.2 eller högre)
-Git
-Ubuntu
-Symfony 7

# Klona kurs repot

Nu ska ska vi ta en titt på hur vi kan klona repot.
För att klona repot till din lokala dator, använda följande steg:

1. Öpnna terminalen Ubuntu.
2.Navigera till den mapp där du vill att projektet ska ligga. I denna kurs utgår i från cd dbwebb-kurser/mvc/me/report.
3.Klona repot genom att köra:
git clone https://github.com/username/repository.git.

# Starta Webbplatsen

Nu har vi lyckats ta oss här långt, då kan vi starta upp webbplatsen med Symfony 7. Följ dessa steg:
1.navigerar till projekt mappen
cd dbwebb-kurser/mvc/me/report
2.Starta servern med kommandot php -S localhost:8888 -t public.

# Utforska Webbsidan

För att navigera på webbplatsen, använd följande routes:

    Home: http://localhost:8888/home - Visar en presentation om mig och projektet.
    Presentation: Utforska mer om projektet och dess syfte.
    About: Lär dig mer om utvecklarna bakom projektet.
    Lucky: En rolig feature som visar en slumpmässig sida.
    Report: Se utvecklingsrapporter och framsteg.
    JSON Routes: Utforska API:er och data i JSON-format.

    webbplatsen kommer framöver uppdateras med nya funktioner och information, men vi kommer informera om detta.
