<?php
namespace Concrete\Core\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Package;
use Exception;

class UninstallPackageCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('c5:package-uninstall')
            ->addOption('trash', null, InputOption::VALUE_NONE, 'If this option is specified the package directory will be moved to the trash directory')
<<<<<<< HEAD
            ->addArgument('package', InputArgument::REQUIRED, 'The handle of the package to be uninstalled')
            ->setDescription('Uninstall a concrete5 package')
            ->setHelp(<<<EOT
Returns codes:
  0 operation completed successfully
  1 errors occurred
EOT
            )
=======
            ->addOption('full-content-swap', null, InputOption::VALUE_NONE, 'If this option is specified a full content swap will be performed (if the package supports it)')
            ->addArgument('package', InputArgument::REQUIRED, 'The handle of the package to be uninstalled')
            ->setDescription('Uninstall a concrete5 package')
>>>>>>> origin/master
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
<<<<<<< HEAD
        $rc = 0;
=======
>>>>>>> origin/master
        try {
            $pkgHandle = $input->getArgument('package');

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
            $test = $pkg->testForUninstall();
            if ($test !== true) {
                throw new Exception(implode("\n", Package::mapError($test)));
            }
<<<<<<< HEAD
            $output->writeln('<info>good.</info>');

            $output->write('Uninstalling package... ');
            $pkg->uninstall();
            $output->writeln('<info>done.</info>');
=======
            $output->writeln('good.');

            $output->write('Uninstalling package... ');
            $pkg->uninstall();
            $output->writeln('done.');
>>>>>>> origin/master

            if ($input->getOption('trash')) {
                $output->write('Moving package to trash... ');
                $r = $pkg->backup();
                if (is_array($r)) {
                    throw new Exception(implode("\n", Package::mapError($r)));
                }
<<<<<<< HEAD
                $output->writeln('<info>done.</info>');
            }
        } catch (Exception $x) {
            $output->writeln($x->getMessage());
            $rc = 1;
        }

        return $rc;
=======
                $output->writeln('done.');
            }
        } catch (Exception $x) {
            $output->writeln($x->getMessage());

            return 1;
        }
>>>>>>> origin/master
    }
}
