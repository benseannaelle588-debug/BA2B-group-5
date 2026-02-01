<?pHp 
//1. the flyweight holds the intrinsic (shared) state
class  TreeType{
    private string $name;
    private string $color;
        public function __construct(string $name, string $color){
            $this->name = $name;
            $this->color = $color;
            // this important line: We print a message only when a new type is created
            echo"--> Creating New shared TreeType: {$color} {$name}\n"; 
        }
        public function draw(int $x, int $y):string{
            return "Drawing a **{$this->color} {$this->name}** at position ({$x},{$y})";
        }
}
//2. the factory: Manage the pool of flyweight
class TreeFactory{
    private static array $treeTypes = [];
    public static function getTreeType(string $name, string $color): TreeType{ $key ="{$name}_{$color}";
        if(!isset(self::$treeTypes[$key])){
            self::$treeTypes[$key] = new TreeType($name, $color);}
            return self::$treeTypes[$key];
        }
}
// 3. Execution(the client code)
echo"\n--Planting Trees--\n";
// tree 1. need a new oak tree
$tree1 = TreeFactory::getTreeType("OAK","Brown");
// tree 2
$tree2 = TreeFactory::getTreeType("pine","Green");
$tree3 = TreeFactory::getTreeType("OAK","Brown");
$tree4 = TreeFactory::getTreeType("pine","Green");
echo"\n--Result:Only 2 Unique Objective Created--\n";
echo"1.". $tree1->draw(10, 50). "\n";
echo"2.". $tree2->draw(20, 100). "\n";
echo"3.". $tree3->draw(30, 150). "\n";
echo"4.". $tree4->draw(40, 200). "\n";
if($tree1==$tree3){
    echo"\nSuccess!Tree1 and Tree3 reference the SAME object in memory.\n";
}else{
    echo"\n Error!Object are not shared.\n";
}
?>