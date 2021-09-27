import Navbar from './components/Navbar'
import RankTable from './components/RankTable'
import Game from './components/Game'

const App = () => {
  return (
    <div className="container">
      <Navbar />
      <RankTable />
      <Game />
    </div>
  );
}

export default App;
