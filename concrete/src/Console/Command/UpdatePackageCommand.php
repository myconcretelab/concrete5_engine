<?php
namespace Concrete\Core\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use Package;
use Exception;

class UpdatePackageCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('c5:package-update')
            ->addOption('all', 'a', InputOption::VALUE_NONE, 'Update all the installed packages')
            ->addOption('force', 'f', InputOption::VALUE_NONE, 'Force update even if the package is already at last version')
<<<<<<< HEAD
            ->addArgument('packages', InputArgument::IS_ARRAY, 'The handle of the package to be updated (multiple values allowed)')
            ->setDescription('Update a concrete5 package')
            ->setHelp(<<<EOT
Returns codes:
  0 operation completed successfully
  1 errors occurred
EOT
            )
=======
            ->addArgument('package', InputArgument::OPTIONAL, 'The handle of the package to be updated')
            ->setDescription('Update a concrete5 package')
>>>>>>> origin/master
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $rc = 0;
        try {
<<<<<<< HEAD
            $updatableHandles = array();
            $force = $input->getOption('force');
            if ($input->getOption('all')) {
                if (count($input->getArgument('packages')) > 0) {
                    throw new Exception('If you use the --all option you can\'t specify package handles.');
                }
                if ($force) {
                    foreach (Package::getInstalledHandles() as $pkgHandle) {
                        $updatableHandles[] = $pkgHandle;
                    }
                    if (empty($updatableHandles)) {
                        $output->writeln("No package has been found.");
                    }
                } else {
                    foreach (Package::getLocalUpgradeablePackages() as $pkg) {
                        $updatableHandles[] = $pkg->getPackageHandle();
                    }
                    if (empty($updatableHandles)) {
                        $output->writeln("No package needs to be updated.");
                    }
                }
            } else {
                $updatableHandles = $input->getArgument('packages');
                if (empty($updatableHandles)) {
                    throw new Exception('No package handle specified and the --all option has not been specified.');
                }
            }
            foreach ($updatableHandles as $updatableHandle) {
                try {
                    $this->updatePackage($updatableHandle, $output, $force);
                } catch (Exception $x) {
                    $output->writeln('<error>'.$x->getMessage().'</error>');
                    $rc = 1;
                }
            }
        } catch (Exception $x) {
            $output->writeln('<error>'.$x->getMessage().'</error>');
=======
            $pkgHandle = $input->getArgument('package');
            $force = $input->getOption('force');
            if ($input->getOption('all')) {
                if ($pkgHandle !== null) {
                    throw new Exception('If you use the --all option you can\'t specify a package handle.');
                }
                if ($force) {
                    foreach (Package::getInstalledHandles() as $pkgHandle) {
                        try {
                            $this->updatePackage($pkgHandle, $output, $force);
                        } catch (Exception $x) {
                            $output->writeln($x->getMessage());
                            $rc = 1;
                        }
                    }
                } else {
                    $updatablePackages = Package::getLocalUpgradeablePackages();
                    if (empty($updatablePackages)) {
                        $output->writeln("No package needs to be updated.");
                    } else {
                        foreach ($updatablePackages as $pkg) {
                            try {
                                $this->updatePackage($pkg->getPackageHandle(), $output, $force);
                            } catch (Exception $x) {
                                $output->writeln($x->getMessage());
                                $rc = 1;
                            }
                        }
                    }
                }
            } elseif ($pkgHandle === null) {
                throw new Exception('No package handle specified and the --all option has not been specified.');
            } else {
                $this->updatePackage($pkgHandle, $output, $force);
            }
        } catch (Exception $x) {
            $output->writeln($x->getMessage());
>>>>>>> origin/master
            $rc = 1;
        }

        return $rc;
    }

    protected function updatePackage($pkgHandle, OutputInterface $output, $force)
    {
        $output->write("Looking for package '$pkgHandle'... ");
        $pkg = null;
        foreach (Package::getInstalledList() as $installed) {
            if ($installed->getPackageHandle() === $pkgHandle) {
                $pkg = $installed;
                break;
            }
        }
        if ($pkg === null) {
            throw new Exception(sprintf("No package with handle '%s' is installed", $pkgHandle));
        }
<<<<<<< HEAD
        $output->writeln(sprintf('<info>found (%s).</info>', $pkg->getPackageName()));
=======
        $output->writeln(sprintf('found (%s).', $pkg->getPackageName()));
>>>>>>> origin/master

        $output->write('Checking preconditions... ');
        $upPkg = null;
        foreach (Package::getLocalUpgradeablePackages() as $updatable) {
            if ($updatable->getPackageHandle() === $pkgHandle) {
                $upPkg = $updatable;
                break;
            }
        }
        if ($upPkg === null && $force !== true) {
<<<<<<< HEAD
            $output->writeln(sprintf("<info>the package is already up-to-date (v%s)</info>", $pkg->getPackageVersion()));
=======
            $output->writeln(sprintf("the package is already up-to-date (v%s)", $pkg->getPackageVersion()));
>>>>>>> origin/master
        } else {
            $test = Package::testForInstall($pkgHandle, false);
            if ($test !== true) {
                throw new Exception(implode("\n", Package::mapError($r)));
            }
<<<<<<< HEAD
            $output->writeln('<info>good.</info>');

            if ($upPkg === null) {
                $output->write(sprintf('Forcing upgrade at v%s... ', $pkg->getPackageVersion()));
                $upPkg = Package::getByHandle($pkgHandle);
            } else {
                $output->write(sprintf('Updating from v%s to v%s... ', $upPkg->getPackageCurrentlyInstalledVersion(), $upPkg->getPackageVersion()));
            }
            $upPkg->upgradeCoreData();
            $upPkg->upgrade();
            $output->writeln('<info>done.</info>');
=======
            $output->writeln('good.');

            if ($upPkg === null) {
                $output->write(sprintf('Forcing upgrade at v%s...', $pkg->getPackageVersion()));
                $upPkg = Package::getByHandle($pkgHandle);
            } else {
                $output->write(sprintf('Updating from v%s to v%s...', $upPkg->getPackageCurrentlyInstalledVersion(), $upPkg->getPackageVersion()));
            }
            $upPkg->upgradeCoreData();
            $upPkg->upgrade();
            $output->writeln('done.');
>>>>>>> origin/master
        }
    }
}
