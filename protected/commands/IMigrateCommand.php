<?php

Yii::import('system.cli.commands.MigrateCommand');

class IMigrateCommand extends MigrateCommand
{

    public $oldMigrationFolderName = 'old';
    const MAX_MIGRATION_COUNT = 10;

    public function actionCreate($args)
    {
        if (isset($args[0])) {
            $name = $args[0];
        } else {
            $this->usageError('Please provide the name of the new migration.');
        }

        if (!preg_match('/^\w+$/', $name)) {
            die("Error: The name of the migration must contain letters, digits and/or underscore characters only.\n");
        }

        $name = 'm' . gmdate('ymd_His') . '_' . $name;
        $content = strtr($this->getTemplate(), array('{ClassName}' => $name));
        $file = $this->migrationPath . DIRECTORY_SEPARATOR . $name . '.php';

        if ($this->confirm("Create new migration '$file'?")) {
            file_put_contents($file, $content);
            echo "New migration created successfully.\n";

            //move old migrations to folder
            $scanned = scandir($this->migrationPath);
            array_splice($scanned, 0, 3);

            if (in_array($this->oldMigrationFolderName, $scanned)) {
                unset($scanned[array_search($this->oldMigrationFolderName, $scanned)]);
            }

            if (count($scanned) >= self::MAX_MIGRATION_COUNT) {
                if (!is_dir($this->migrationPath . DIRECTORY_SEPARATOR . $this->oldMigrationFolderName)) {
                    mkdir($this->migrationPath . DIRECTORY_SEPARATOR . $this->oldMigrationFolderName);
                }
                echo(string) count($scanned) - self::MAX_MIGRATION_COUNT;

                $oldMigrations = array_slice($scanned, 0, count($scanned) - self::MAX_MIGRATION_COUNT);
                foreach ($oldMigrations as $migration) {
                    rename(
                        $this->migrationPath . DIRECTORY_SEPARATOR . $migration,
                        $this->migrationPath . DIRECTORY_SEPARATOR . $this->oldMigrationFolderName . DIRECTORY_SEPARATOR . $migration
                    );
                }
            }
            //end custom code
        }
    }

    protected function getNewMigrations()
    {
        $applied = array();
        foreach ($this->getMigrationHistory(-1) as $version => $time) {
            $applied[substr($version, 1, 13)] = true;
        }

        $migrations = array();

        //read old migrations folder
        if (is_dir($this->migrationPath . DIRECTORY_SEPARATOR . $this->oldMigrationFolderName)) {
            $handle = opendir($this->migrationPath . DIRECTORY_SEPARATOR . $this->oldMigrationFolderName);
            while (($file = readdir($handle)) !== false) {
                if ($file === '.' || $file === '..') {
                    continue;
                }
                $path = $this->migrationPath . DIRECTORY_SEPARATOR . $this->oldMigrationFolderName . DIRECTORY_SEPARATOR . $file;
                if (preg_match('/^(m(\d{6}_\d{6})_.*?)\.php$/', $file, $matches) && is_file($path) && !isset($applied[$matches[2]])) {
                    $migrations[] = $matches[1];
                }
            }
            closedir($handle);
        }
        //end custom code

        $handle = opendir($this->migrationPath);
        while (($file = readdir($handle)) !== false) {
            if ($file === '.' || $file === '..') {
                continue;
            }
            $path = $this->migrationPath . DIRECTORY_SEPARATOR . $file;
            if (preg_match('/^(m(\d{6}_\d{6})_.*?)\.php$/', $file, $matches) && is_file($path) && !isset($applied[$matches[2]])) {
                $migrations[] = $matches[1];
            }
        }
        closedir($handle);
        sort($migrations);
        return $migrations;
    }

    protected function instantiateMigration($class)
    {
        if (is_file($this->migrationPath . DIRECTORY_SEPARATOR . $class . '.php')) {
            $file = $this->migrationPath . DIRECTORY_SEPARATOR . $class . '.php';
        } else {
            $file = $this->migrationPath . DIRECTORY_SEPARATOR . $this->oldMigrationFolderName . DIRECTORY_SEPARATOR . $class . '.php';
        }

        require_once($file);
        $migration = new $class;
        $migration->setDbConnection($this->getDbConnection());
        return $migration;
    }

}
