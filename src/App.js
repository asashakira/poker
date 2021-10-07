import Navbar from './components/Navbar'
import RankTable from './components/RankTable'
import Game from './components/Game'
import Info from './components/Info'

const App = () => {
  return (
    <div className="container">
      <Navbar />
      <RankTable ranks={ranks} />
      <Game ranks={ranks} />
      <Info />
    </div>
  );
}

const ranks = [
  {
    id: 0,
    text: "ぶた",
    bet: 0,
  },
  {
    id: 1,
    text: "ツーペア",
    bet: 100,
  },
  {
    id: 2,
    text: "スリーカード",
    bet: 100,
  },
  {
    id: 3,
    text: "ストレート",
    bet: 100,
  },
  {
    id: 4,
    text: "フラッシュ",
    bet: 100,
  },
  {
    id: 5,
    text: "フルハウス",
    bet: 100,
  },
  {
    id: 6,
    text: "フォーカード",
    bet: 100,
  },
  {
    id: 7,
    text: "ストレートフラッシュ",
    bet: 100,
  },
  {
    id: 8,
    text: "ファイブカード",
    bet: 100,
  },
  {
    id: 9,
    text: "ロイヤルストレートフラッシュ",
    bet: 100,
  },
  {
    id: 10,
    text: "ロイヤルストレートスライム",
    bet: 100,
  },
];

export default App;
