import Navbar from './components/Navbar'
import RankTable from './components/RankTable'
import Game from './components/Game'
import Text from './components/Text'
import Info from './components/Info'

const App = () => {
  return (
    <div className="container">
      <Navbar />
      <RankTable />
      <Game />
      <Text />
      <Info />
    </div>
  );
}

export default App;
