<?php
// in your server start command
$process = new Process('/usr/bin/php bin/chat-server.php');
$process->start();
sleep(1);
if ($process->isRunning()) {
    echo "Server started.\n";
} else {
    echo $process->getErrorOutput();
}

// in your server stop command
$process = new Process('ps ax | grep bin/chat-server.php');
$process->run();
$output = $process->getOutput();
$lines = preg_split('/\n/', $output);
// kill everything (there can be multiple processes if they are spawned)
$stopped = False;
foreach ($lines as $line) {
    $ar = preg_split('/\s+/', trim($line));
    if (in_array('/usr/bin/php', $ar)
        and in_array('bin/chat-server.php', $ar)) {
        $pid = (int) $ar[0];
        posix_kill($pid, SIGKILL);
        $stopped = True;
    }
}
if ($stopped) {
    echo "Server stopped.\n";
} else {
    echo "Server not found. Are you sure it's running?\n";
}
?>