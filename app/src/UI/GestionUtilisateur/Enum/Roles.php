<?php declare(strict_types=1);
namespace UI\GestionUtilisateur\Enum;

enum Roles: string
{
    use EnumToArray;
    case Utilisateur = 'ROLE_USER';

    case Moderateur = 'ROLE_MOD';
    case Administrateur = 'ROLE_ADMIN';

}

trait EnumToArray
{

  public static function names(): array
  {
    return array_column(self::cases(), 'name');
  }

  public static function values(): array
  {
    return array_column(self::cases(), 'value');
  }

  public static function array(): array
  {
    return array_combine(self::values(), self::names());
  }

}
?>