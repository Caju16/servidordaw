<?php

/**
 *  Array verbos irregulares
 *  @author Miguel Carmona
 * 
 */

$irregular_verbs = [
    ["base" => "be", "past" => "was/were", "past_participle" => "been"],
    ["base" => "begin", "past" => "began", "past_participle" => "begun"],
    ["base" => "choose", "past" => "chose", "past_participle" => "chosen"],
    ["base" => "do", "past" => "did", "past_participle" => "done"],
    ["base" => "go", "past" => "went", "past_participle" => "gone"],
    ["base" => "have", "past" => "had", "past_participle" => "had"],
    ["base" => "see", "past" => "saw", "past_participle" => "seen"],
    ["base" => "take", "past" => "took", "past_participle" => "taken"],
    ["base" => "write", "past" => "wrote", "past_participle" => "written"],
];

echo "<table border='1'>";
echo "<tr><th>Base Form</th><th>Past Simple</th><th>Past Participle</th></tr>";

foreach ($irregular_verbs as $verb) {
    echo "<tr>";
    echo "<td>{$verb['base']}</td>";
    echo "<td>{$verb['past']}</td>";
    echo "<td>{$verb['past_participle']}</td>";
    echo "</tr>";
}

echo "</table>";
?>
