<?php
include 'includes/init.php';
include 'includes/org/phpcaptcha/securimage/securimage.php';
include 'includes/head.php';
use de\zweiradspion\HeaderHelper,
    de\zweiradspion\NavigationHelper,
    de\zweiradspion\Fahrrad,
    de\zweiradspion\Kontakt,
    de\zweiradspion\Mail;
?>
<body id="std">
<?=HeaderHelper::getHeader('AGB')?>
    <div id="content">
        <?=NavigationHelper::getSubnavigation()?>
        <ul class="agb">
            <li>§ 1 Allgemeines
                <ol>
                    <li>Die Betreiberin betreibt ein Internetportal rund um den Bereich Automobile ("zweiradspion.de"). Anbieter können sich registrieren, um dann unentgeltlich Inserate über eine Eingabemaske einzugeben und in der Datenbank der Betreiberin zu speichern. Die gespeicherten Inserate können von den Nutzern abgerufen werden.</li>
                    <li>Die Betreiberin macht sich die Inserate nicht zu Eigen und prüft diese und die sonstigen Angaben der Anbieter nicht auf Richtig- und Vollständigkeit. An sämtlichen Kaufvertragsabschlüssen und anderen Verträgen zwischen Anbietern und Nutzern oder zwischen Anbietern ist die Betreiberin nicht als Partei, Vertreter, Erfüllungsgehilfen oder sonstwie beteiligt.</li>
                </ol>
            </li>
            <li>§ 2 Definitionen<br>
                Für diese Allgemeinen Geschäftsbedingungen gelten folgende Definitionen:
                <ol>
                    <li>"Betreiberin" ist die Zweiradspion GmbH, Friedrichstraße 50, 10117 Berlin.</li>
                    <li>"Zweiräder" sind alle fahrenden und eigenständig fahrende Fortbewegungsmittel, Fahrräder und Elektrofahrräder.</li>
                    <li>"Gewerbliche Anbieter" sind Personen, die in Ausübung ihrer gewerblichen oder selbständigen Tätigkeit im Sinne von § 14 BGB ein Kraftfahrzeug zum Kauf anbieten.</li>
                    <li>"Private Anbieter" sind Personen, die rein privat im Sinne von § 13 BGB ein Zweirad zum Kauf anbieten.</li>
                    <li>"Anbieter" sind private und gewerbliche Anbieter.</li>
                    <li>"Inserate" sind unverbindliche Anzeigen, die Eigenschaften von zum Verkauf stehenden Zweirädern sowie Kaufpreise oder Kaufpreisvorstellungen beschreiben und zudem Informationen zur Kontaktaufnahme mit Anbietern und die Identität der Anbieter beinhalten.</li>
                    <li>"Anmeldedaten" sind Benutzername und Kennwort, die der Anbieter bei der Registrierung selbst bestimmt.</li>
                    <li>"Anbieterbereich" sind die Internetseiten und Inhalte des Internetportals, die nur nach der Registrierung und Eingabe der Anmeldedaten aufgerufen werden können.</li>
                    <li>"Öffentlicher Bereich" sind die Internetseiten und Inhalte des Internetportals, die von jedermann aufgerufen werden können, ohne dass es einer Registrierung oder Anmeldung bedarf.</li>
                    <li>"Nutzer" sind Personen, die den öffentlichen Bereich nutzen und Informationen abfragen.</li>
                    <li>"Mitgliedschaft" ist der Zustand, in dem sich ein Anbieter nach erfolgreicher Registrierung jederzeit mit seinen Anmeldedaten in den Anbieterbereich einloggen kann.</li>
                    <li>"Sperren" bedeutet, dass von einem Anbieter eingegebene Inhalte nicht mehr im öffentlichen Bereich angezeigt werden.</li>
                    <li>"Löschen" bedeutet, dass von einem Anbieter eingegebene Inhalte nicht mehr im öffentlichen Bereich angezeigt und aus der Datenbank der Betreiberin entfernt werden.</li>
                    <li>"Dritte" sind Anbieter, Nutzer und andere natürliche und juristische Personen.</li>
                </ol>
            </li>
            <li>§ 3 Geltungsbereich
                <ol>
                    <li>Diese Allgemeinen Geschäftsbedingungen gelten für das Rechtsverhältnis zwischen der Betreiberin und dem Anbieter im Zusammenhang mit der Nutzung des Internetportals.</li>
                    <li>Abweichende Geschäftsbedingungen der Anbieter oder Änderungen und Ergänzungen zu diesen Allgemeinen Geschäftsbedingungen erlangen nur dann Geltung zwischen den Parteien, wenn die Betreiberin in schriftlicher Form zustimmt.</li>
                    <li>Diese Allgemeinen Geschäftsbedingungen werden mit der Registrierung im Sinne von § 5 Vertragsbestandteil.</li>
                </ol>
            </li>
            <li>§ 4 Leistungsangebot der Betreiberin
                <ol>
                    <li>Die Anbieter können auf dem von der Betreiberin betriebenen Internetportal kostenlos Inserate einstellen, die in der Datenbank der Betreiberin gespeichert werden. Voraussetzung ist, dass sich der Anbieter vorher als privater oder gewerblicher Anbieter gemäß § 5 registriert.</li>
                    <li>Mit der Aufnahme eines Inserates in die Datenbank wird dieses nach einer redaktionellen Kontrolle auf dem Internetportal den Nutzern angezeigt. Hierzu wird eine Suchmaske mit Suchparametern zur Verfügung gestellt. Ein Inserat wird angezeigt, wenn es eingegebene Suchparameter trifft.</li>
                    <li>Im Anbieterbereich werden Funktionen zur Verwaltung der Inserate angeboten.</li>
                    <li>Auf Verfügbarkeit und Teilhabe an dem Angebot der Betreiberin sowie auf die Anzeige eines Inserates auch bei zutreffenden Suchparametern besteht kein Rechtsanspruch. Die Betreiberin ist bemüht, das Internetportal im Rahmen des aktuellen Standes der Technik verfügbar zu halten, und wird die Teilhabe nicht aus Willkür verwehren.</li>
                </ol>
            </li>
            <li>§ 5 Registrierung als Anbieter
                <ol>
                    <li>Natürliche und juristische Personen müssen sich registrieren, um den Anbieterbereich nutzen und Inserate einstellen zu können.</li>
                    <li>Voraussetzung für die Registrierung ist die unbeschränkte Geschäftsfähigkeit des jeweils registrierten Anbieters. Werden juristische Personen als Anbieter registriert, so muss der Anmelder berechtigt sein, die juristische Person insoweit zu vertreten und sich selbst namentlich benennen.</li>
                    <li>Die Registrierung ist unzulässig, wenn in der Person des Anbieters Gründe für einen Insolvenzantrag bestehen oder ein Insolvenzverfahren beantragt oder eröffnet oder mangels Masse abgelehnt wurde.</li>
                    <li>Für die Registrierung sind Eingabemasken vorgesehen; diese richten sich speziell an den privaten einerseits und an den gewerblichen Anbieter andererseits. Um zu den jeweiligen Eingabemasken zu gelangen ist entweder der Button "Privatanbieter" oder "Händler" anzuklicken. Gewerbliche Anbieter sind verpflichtet, sich als solche zu registrieren.</li>
                    <li>Der Anbieter ist verpflichtet, die abgefragten Informationen über sich vollständig, ordnungsgemäß und der Wahrheit entsprechend anzugeben.</li>
                    <li>Mit der Absendung der Daten nimmt der Anbieter das Angebot der Betreiberin auf Abschluss des Nutzungsvertrages unter Einbezug dieser Allgemeinen Geschäftsbedingungen sowie der Datenschutzrichtlinie an. Ferner gibt er die Datenschutzeinwilligungserklärung ab. In der Folge besteht die Mitgliedschaft des Anbieters.</li>
                    <li>Der Anbieter bekommt eine Bestätigungs-E-Mail zugeschickt, in der ein Link und die Anmeldedaten enthalten sind. Durch Anklicken dieses Links bestätigt der Anbieter den Erhalt der E-Mail und schließt den Registrierungsvorgang ab.</li>
                </ol>
            </li>
            <li>§ 6 Nutzung durch den Anbieter
                <ol>
                    <li>Jeder Anbieter kann unlimitiert Inserate in die Datenbank der Betreiberin einstellen und verwalten.</li>
                    <li>Gewerbliche Anbieter dürfen Inserate nur in dieser Eigenschaft einstellen und verwalten. Die steigende Anzahl der Inserate kann dazu führen, dass ein privater Anbieter zu einem gewerblichen Anbieter wird.</li>
                    <li>Der private Anbieter ist verpflichtet, sofern er gemäß Abs. 2 S. 2 zu einem gewerblichen Anbieter wird, seinen Anbieteraccount als privater Anbieter zu löschen, um sich dann als gewerblicher Anbieter zu registrieren.</li>
                    <li>Die Anbieter können Inserate jederzeit löschen oder verändern.</li>
                    <li>Der Anbieter ist verpflichtet, unverzüglich die eingegebenen Inhalte zu verändern, sobald sie von den tatsächlichen Verhältnissen abweichen.</li>
                </ol>
            </li>
            <li>§ 7 Einschränkung der Nutzungsmöglichkeiten
                <ol>
                    <li>Wartungs- und Weiterentwicklungsarbeiten können dazu führen, dass die Anmeldung zum Anbieterbereich oder die Nutzung des Anbieterbereichs für eine bestimmte Zeit nicht möglich ist. Die Betreiberin ist bemüht, etwaige Einschränkungen der Verfügbarkeit vorher anzuzeigen; ein Rechtsanspruch darauf besteht nicht.</li>
                    <li>Bei anderweitigen Störungen und Nutzungsbeschränkungen, insbesondere im Falle höherer Gewalt, Betriebsstörungen oder auch Versagen Dritter, derer sich die Betreiberin zur Erbringung ihrer Leistungen bedient (vgl. § 16), kann die Nutzung ohne Vorankündigung beeinträchtigt werden. Die Betreiberin ist in solchen Fällen bemüht, die Störungen oder Nutzungsbeschränkungen abzustellen; ein Rechtsanspruch darauf besteht nicht.</li>
                </ol>
            </li>
            <li>§ 8 Einstellen von Inhalten in die Datenbank
                <ol>
                    <li>Der Anbieter hat für jedes Inserat die spezielle Eingabemaske des Internetportals zu nutzen.</li>
                    <li>Pro Inserat darf nur ein Kraftfahrzeug beworben werden. Für jedes Kraftfahrzeug darf nur ein Inserat erstellt werden. Die bewusste Einstellung eines Kraftfahrzeugs durch mehrere Anbieter ist unzulässig</li>
                    <li>Es dürfen nur Inserate über Zweiräder veröffentlich werden, die auch zum sofortigen Verkauf stehen und ohne Beeinträchtigung von Rechten oder rechtlich geschützten Belangen Dritter übereignet werden können.</li>
                    <li>Gewerbliche Anbieter müssen insbesondere die Anforderungen der PAngVO, wonach Endpreise (bspw. Preise inklusive MwSt.) anzugeben sind, und der PKW-EnVKV beachten.</li>
                    <li>Nicht gestattet ist die Angabe von Servicenummern, die zu erhöhten Telefongebühren führen (insbesondere 0190er-Nummer u. a.).</li>
                    <li>Bei der Einstellung von Zweirad-Inseraten durch Händler und Private sind nur solche Daten gestattet, die sich ausschließlich auf das angebotene Fahrzeug beziehen. Die Einstellung sonstiger, nicht unmittelbar mit dem angebotenen Fahrzeug in Zusammenhang stehender Informationen bedürfen der schriftlichen Genehmigung von Zweiradspion GmbH. Bei missbräuchlicher Nutzung behält sich Zweiradspion GmbH rechtliche Schritte sowie Schadenersatzforderungen vor.</li>
                </ol>
            </li>
            <li>§ 9 Redaktionelle Kontrolle der Inserate
                <ol>
                    <li>Die Betreiberin nimmt eine teils computergesteuerte und teils persönlich durchgeführte redaktionelle Kontrolle vor, bevor ein neu eingegebenes oder verändertes Inserat Nutzern auf dem Internetportal angezeigt wird. Die redaktionelle Kontrolle dient der Korrektur von Tipp- und Rechtschreibfehlern, der Suchmaschinenoptimierung und der Entfernung unsachlicher, rechtswidriger oder gar verbotener Inhalte.</li>
                    <li>Die Betreiberin ist bemüht, das Angebot sachlich und vollständig an die vom Anbieter eingegeben Informationen anzupassen, sodass die angegebenen Eigenschaften eines Kraftfahrzeugs nicht verändert oder verfälscht werden. Sollte dies nicht möglich sein, ist die Betreiberin auch berechtigt, eingegebene Angaben des Anbieters entfallen zu lassen.</li>
                </ol>
            </li>
            <li>§ 10 Sperrung und Löschung von Inseraten
                <ol>
                    <li>Die Betreiberin ist berechtigt, Inserate oder Teile von Inseraten jederzeit vorläufig oder endgültig zu sperren oder zu löschen, ohne dass es eines wichtigen Grundes bedarf oder auch nur ein solcher dem Anbieter mitgeteilt werdenmuss.</li>
                    <li>Der Anbieter hat keinen Rechtsanspruch, dass sein Inserat überhaupt oder in irgendeiner Form oder Häufigkeit angezeigt wird.</li>
                    <li>Während der Sperrung oder nach der Löschung dürfen gesperrte oder gelöschte Inhalte nicht erneut in die Datenbank der Betreiberin eingestellt werden.</li>
                </ol>
            </li>
            <li>§ 11 Beendigung der Nutzung
                <ol>
                    <li>Der Anbieter ist jederzeit berechtigt, seine Mitgliedschaft durch Löschung seines Anbieteraccounts im Anbieterbereich zu beenden.</li>
                    <li>Die Betreiberin ist jederzeit berechtigt, bestimmte Anbieter vorläufig oder endgültig zu sperren oder zu löschen, ohne dass es eines wichtigen Grundes bedarf oder ein solcher dem Anbieter mitgeteilt werden muss. Die Sperrung oder Löschung wird die Betreiberin nur dann vornehmen, wenn der Anbieter gegen diese Allgemeinen Geschäftsbedingungen, die Rechtsordnung oder Rechte oder rechtlich geschützte Belange Dritter oder der Betreiberin verstößt.</li>
                    <li>Während der Sperrung oder nach der Löschung ist es verboten, eine erneute vorzunehmen. Dies gilt auch für eine Scheinanmeldung durch Dritte.</li>
                </ol>
            </li>
            <li>§ 12 Pflichten und Verantwortlichkeit des Anbieters
                <ol>
                    <li>Der Anbieter ist verpflichtet, seine Anmeldedaten gegenüber Dritten geheim zu halten. Sollte der Anbieter Kenntnis davon erlangen, dass ein Dritter von seinen Anmeldedaten Kenntnis erlangt hat, so hat er unverzüglich diese selbst abzuändern.</li>
                    <li>Für die Inserate ist allein der Anbieter verantwortlich. Insbesondere hat er sämtliche Inhalte sachlich, vollständig, ordnungsgemäß, wahrheitsgemäß und verständlich anzugeben. Dies gilt insbesondere für alle preisbildenden Faktoren (etwa Laufleistung, Vorbesitzer, Taxi...) und die Rechtsverhältnisse an dem Fahrzeug.</li>
                    <li>Mit der Einstellung von Inhalten versichert der Anbieter, dass er alle Angaben nach bestem Wissen und Gewissen gemacht hat. Sollte der Anbieter gutgläubig falsche Angaben machen oder sich versehentlich vertippen, hat er nach Kenntniserlangung unverzüglich eine Berichtigung vorzunehmen oder das gesamte Inserat zu löschen.</li>
                    <li>Der Anbieter verpflichtet sich, ausschließlich Inhalte einzustellen, die im Einklang mit diesen Allgemeinen Geschäftsbedingungen und der Rechtsordnung stehen und in keiner Form gegen Rechte oder rechtlich geschützte Belange Dritter oder der Betreiberin verstoßen.</li>
                    <li>Der Anbieter darf nicht aus seinem Inserat auf eigene oder sonstige Internetseiten verlinken, es sei denn, die Betreiberin hat ihre Zustimmung erteilt.</li>
                </ol>
            </li>
            <li>§ 13 Haftung der Betreiberin
                <ol>
                    <li>Die Betreiberin haftet für Schäden nur dann, wenn der Betreiberin bzw. den gesetzlichen Vertretern oder Erfüllungsgehilfen mindestens grobe Fahrlässigkeit oder Vorsatz zu Last fällt oder mindestens fahrlässig wesentliche Vertragspflichten durch solche Personen verletzt werden.</li>
                    <li>Die Betreiberin haftet nur der Höhe nach für typischerweise bei Vertragsschluss vorhersehbare Schäden und nicht für mittelbare Schäden, es sei denn den gesetzlichen Vertretern oder Erfüllungsgehilfen fällt Vorsatz oder grobe Fahrlässigkeit zur Last.</li>
                    <li>Die Betreiberin haftet nur der Höhe nach für typischerweise bei Vertragsschluss vorhersehbare Schäden und nicht für mittelbare Schäden, es sei denn den gesetzlichen Vertretern oder Erfüllungsgehilfen fällt Vorsatz oder grobe Fahrlässigkeit zur Last.</li>
                </ol>
            </li>
            <li>§ 14 Haftung der Anbieter/Freistellung der Betreiberin
                <ol>
                    <li>Der Anbieter haftet für sämtliche Schäden, die durch die Nichteinhaltung dieser Allgemeinen Geschäftsbedingungen, der Rechtsordnung oder die Verletzung von Rechten oder rechtlich geschützten Belangen Dritter oder der Betreiberin entstehen.</li>
                    <li>Der Anbieter hat die Betreiberin von jedweder gerichtlichen oder außergerichtlichen Inanspruchnahme durch Dritte oder Behörden und sonstigen staatlichen Einrichtungen freizustellen und sämtliche Schäden, Kosten und Aufwendungen, die aufgrund einer solchen Inanspruchnahme der Betreiberin entstehen, zu übernehmen. Dies gilt jedoch nur dann, wenn die Inanspruchnahme oder die Schäden durch sein Verhalten verursacht wurden, insbesondere aufgrund von Verstößen gegen diese Allgemeinen Geschäftsbedingungen, die Rechtsordnung oder Rechte und rechtlich geschützte Belange Dritter oder der Betreiberin.</li>
                </ol>
            </li>
            <li>§ 15 Werbung und Werbemaßnahmen durch die Betreiberin
                <ol>
                    <li>Die Betreiberin hat das Recht, auf dem Internetportal eigene und fremde Werbung zu präsentieren. Es bleibt der Betreiberin vorbehalten, Art, Ausmaß, Form, Inhalt und Gestaltung der Werbung und Werbemaßnahmen zu bestimmen.</li>
                    <li>Die Betreiberin hat das Recht, die Kombination, die Struktur, den Umfang, die Art, den Inhalt und die Gestaltung der Werbung im Verhältnis zum Inserat oder zu den Inseraten frei zu bestimmen. Mit den Inseraten werden Finanzierungsangebote und Versicherungsangebote angezeigt und beworben.</li>
                    <li>Der Anbieter hat keinen Rechtsanspruch, in irgendeiner Form auf die Werbung oder Werbemaßnahmen Einfluss zu nehmen. Die Betreiberin hat jedoch zu beachten, dass die Inserate als in sich geschlossene Einheiten angezeigt werden und dass der durchschnittliche, aufmerksame und verständige Nutzer jederzeit erkennen kann, dass nicht die Anbieter hinter einer von der Betreiberin ausgelösten Werbung oder Werbemaßnahme stehen.</li>
                    <li>Die Inhalte von Werbung und Werbemaßnahmen macht sich die Betreiberin nicht zu Eigen und leistet keine Gewähr für die Richtigkeit und Vollständigkeit. Dies gilt auch für die Inhalte der Internetseiten der Werbepartner für den Fall, dass auf diese direkt verlinkt sein sollte.</li>
                </ol>
            </li>
            <li>§ 16 Datenschutzhinweis
                <ol>
                    <li>Der Schutz der persönlichen Daten der Anbieter hat für die Betreiberin größte Priorität. Die Einhaltung dergesetzlichen Bestimmungen der Bundesrepublik Deutschland wird gewährleistet.</li>
                    <li>Näheres ist der gesonderten Einwilligung in die Datenerhebung und -verwendung und der Datenschutz-Richtlinien zu entnehmen.</li>
                </ol>
            </li>
            <li>§ 17 Urheber- und Markenrechte, Verlinkung auf "zweiradspion.de"
                <ol>
                    <li>Die von der Betreiberin oder Dritten zur Verfügung gestellten Informationen, Daten, Texte, Programme undsonstigen Materialien sowie alle anderen Inhalte sind teilweise urheberrechtlich, markenrechtlich oder durch andere gewerbliche Schutzrechte geschützt. Sie dürfen nicht ohne vorherige Zustimmung des Berechtigten, verändert, vervielfältigt, übermittelt, verwertet, sonstwie genutzt oder Dritten zugänglich gemacht werden.</li>
                    <li>Verlinkungen auf das Internetportal oder einzelne Inhalte sind ausschließlich zulässig, wenn die Betreiberin vorher schriftlich zugestimmt hat.</li>
                </ol>
            </li>
            <li>§ 18 Leistungen Dritter
                <ol>
                    <li>Die Betreiberin ist berechtigt, Leistungen oder Teilleistungen im Zusammenhang mit dem Betrieb des Internetportals durch Dritte erbringen zu lassen.</li>
                    <li>Die Betreiberin ist zudem berechtigt, Inserate bzw. umfassende Datensätze von Dritten zu beziehen und auf dem Internetportal anzeigen zu lassen.</li>
                </ol>
            </li>
            <li>§ 19 Änderungen dieser Allgemeinen Geschäftsbedingungen
                <ol>
                    <li>Die Betreiberin behält sich das Recht vor, die Allgemeinen Geschäftsbedingungen abzuändern.</li>
                    <li>Der Anbieter wird bei der nächsten Anmeldung zum Anbieterbereich von der Geltung der neuen Regelungen in Kenntnis gesetzt und über die Änderungen unter drucktechnischer Hervorhebung informiert.</li>
                    <li>Stimmt der Anbieter den Änderungen zu, werden die neuen Regelungen Vertragsgrundlage zwischen der Betreiberin und dem Anbieter.</li>
                    <li>Stimmt der Anbieter den Änderungen nicht zu, kann wird er für das Einstellen neuer Inserate gesperrt. Die Betreiberin kann zudem den Anbieteraccount des Anbieters und die bestehenden Inserate löschen.</li>
                </ol>
            </li>
            <li>§ 20 Salvatorische Klausel, Gerichtsstand, Geltung deutschen Rechtes
                <ol>
                    <li>Sollten einzelne Klauseln dieser Allgemeinen Geschäftsbedingungen oder auch nur Teile von solchen unwirksam sein, so berührt dies nicht die Wirksamkeit der anderen Klauseln oder Teile von solchen. An die Stelle unwirksamer Klauseln oder Teile von Klauseln treten die dem rechtsunwirksamen Regelungsinhalt in rechtlich zulässiger Weise am ehesten entsprechenden Regelungen.</li>
                    <li>Der Gerichtstand ist, soweit dies zulässig vereinbart werden kann, Mainz.</li>
                    <li>Es gilt das Recht der Bundesrepublik Deutschland unter Ausschluss des UN-Kaufrechtes.</li>
                </ol>
            </li>
        </ul>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
