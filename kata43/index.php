<?php declare(strict_types=1);

echo "Enter your name: ";
$name = trim(fgets(STDIN));

echo "Enter your email: ";
$email = trim(fgets(STDIN));

echo "Enter your role (user/guest): ";
$role = trim(fgets(STDIN));

echo "You entered:\n";
echo "Name: $name\n";
echo "Email: $email\n";
echo "Role: $role\n";