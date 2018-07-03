<h1>Welcome</h1>

<p>This is home page</p>

<h2>Hi, <?php echo htmlspecialchars($username); ?>.</h2>

<?php
echo "<h3>Faithgoals</h3>";
echo "<ul>";
foreach ($faithgoals as $fg) {
	echo "<li>" . htmlspecialchars($fg) . "</li>";
}
echo "</ul>";
