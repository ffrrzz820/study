// (중요)
// 한번에 모든걸 구현할 생각 X
// 쉬운거 하나부터 O

// 좋은 관습 :
// 자주쓰는 셀렉터 변수에 넣어쓰기

const 버튼1 = document.querySelectorAll('.tab-button')[0];
const 버튼2 = document.querySelectorAll('.tab-button')[1];
const 버튼3 = document.querySelectorAll('.tab-button')[2];

버튼1.addEventListener('click', function(){
    버튼1.classList.add('orange');
    버튼2.classList.remove('orange');
    버튼3.classList.remove('orange');
})
버튼2.addEventListener('click', function(){
    버튼2.classList.add('orange');
    버튼1.classList.remove('orange');
    버튼3.classList.remove('orange');
})
버튼3.addEventListener('click', function(){
    버튼3.classList.add('orange');
    버튼1.classList.remove('orange');
    버튼2.classList.remove('orange');
})