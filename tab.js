// (중요)
// 한번에 모든걸 구현할 생각 X
// 쉬운거 하나부터 O

// 좋은 관습 :
// 자주쓰는 셀렉터 변수에 넣어쓰기

// for 반복문 쓰면
// 코드 복붙해줍니다

// for 반복문 쓰는 법
// for (횟수){
//     복붙할코드
// }
const 버튼 = document.querySelectorAll('.tab-button');
const 설명 = document.querySelectorAll('.tab-content');
const 갯수 = 버튼.length;

for (let i = 0; i < 갯수; i++){ // 3회라는 뜻임

    버튼[i].addEventListener('click', function(){
        탭열기(i);
    })

    function 탭열기(구멍){
        버튼.forEach((e) => {
            e.classList.remove('orange');
        });
        설명.forEach((e) => {
            e.classList.remove('show');
        });
        
        버튼[구멍].classList.add('orange');
        설명[구멍].classList.add('show');
    }

}
// 시작은 i = 0
// 복붙할 때마다 i+1
// 3 되면 끝내셈

// 변수i    복붙여부
// 0        ok
// 1        ok
// 2        ok
// 3        X

// for 문법은 코드복붙보다는 반복실행이 맞음(별차이없음)



// const 버튼1 = document.querySelectorAll('.tab-button')[0];
// const 버튼2 = document.querySelectorAll('.tab-button')[1];
// const 버튼3 = document.querySelectorAll('.tab-button')[2];

// 버튼1.addEventListener('click', function(){
//     버튼1.classList.add('orange');
//     버튼2.classList.remove('orange');
//     버튼3.classList.remove('orange');
// })
// 버튼2.addEventListener('click', function(){
//     버튼2.classList.add('orange');
//     버튼1.classList.remove('orange');
//     버튼3.classList.remove('orange');
// })
// 버튼3.addEventListener('click', function(){
//     버튼3.classList.add('orange');
//     버튼1.classList.remove('orange');
//     버튼2.classList.remove('orange');
// })