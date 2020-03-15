package com.example.todo;


import androidx.annotation.RequiresApi;
import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import java.text.ParseException;
import java.text.SimpleDateFormat;

import android.os.Build;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.TextView;
import android.widget.Toast;

import java.util.ArrayList;
import java.util.Date;
import java.util.List;
import butterknife.BindView;
import butterknife.ButterKnife;

public class MainActivity extends AppCompatActivity {
    @BindView(R.id.btn_add)
    Button btnAdd;
    @BindView(R.id.text_date)
    TextView datetext;
    @BindView(R.id.text_thing)
    TextView thingtext;
    @BindView(R.id.datepicker)
    DatePicker datePicker;
    @BindView(R.id.recycler_view)
    RecyclerView recyclerView;

//    ListView lv=new ListView(this);
    //日期与字符串互转方法
    SimpleDateFormat sdf = new SimpleDateFormat( " yyyy-MM-dd" );
    List<Thing> mthingList=new ArrayList<>();
    public ThingAdapter adapter=new ThingAdapter(mthingList);//设置新的时间适配器，用于处理事件列表
    @RequiresApi(api = Build.VERSION_CODES.O)
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        //初始化操作
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        ButterKnife.bind(this);
        datetext.setFocusable(false); //失去焦点，点击日期文本框不在弹出输入法
        datePicker.setVisibility(View.INVISIBLE);//日历设置不可见
        //设置点击日历表的事件
        initListner();              //初始化监听器
        initThings();               //初始化事件列表
    }

    @RequiresApi(api = Build.VERSION_CODES.O)
    public void initListner(){
        datetext.setOnClickListener(date_click);//日期文本框点击后打开日历的动作
        datePicker.setOnDateChangedListener(date);//日历选择新日期后的动作
        btnAdd.setOnClickListener(btn_click);//添加按钮的动作
    }

    public View.OnClickListener btn_click=new View.OnClickListener(){
        //方法用于点击按钮之后把现有的事件名称和日期加入到list中
        @Override
        public void onClick(View v) {
            String thing_name= thingtext.getText().toString();
            String thing_date= datetext.getText().toString();
            add_thing(thing_name,thing_date);
            thingtext.setText( "请输入事件名" );
        }
    };

    public View.OnClickListener date_click=new View.OnClickListener() {
        //方法用于点击日期栏选择日期
        @Override
        public void onClick(View v) {
            datePicker.setVisibility(View.VISIBLE);//设置日历可见
            recyclerView.setVisibility(View.INVISIBLE);
            datePicker.bringToFront();//把日历显示到最前方，防止和recyclerlist冲突
        }
         };

    public DatePicker.OnDateChangedListener date=new DatePicker.OnDateChangedListener() {
        //点击日历后把选定的日期转换成字符串写入到日期文本中去
        @Override
        public void onDateChanged(DatePicker view, int year, int monthOfYear, int dayOfMonth) {
            datetext.setText(year+"-"+(monthOfYear+1)+"-"+dayOfMonth);
            datePicker.setVisibility(View.INVISIBLE);//设置完后不可见
            recyclerView.setVisibility(View.VISIBLE);
        }
    };

    public class ThingAdapter extends RecyclerView.Adapter<ThingAdapter.ViewHolder> {
        //创建recycler的适配器
        private List<Thing> mThingList;
        //数据源
        class ViewHolder extends RecyclerView.ViewHolder {
            private TextView thing_date;
            private TextView thing_name;
            private Button btn_finish;


            public ViewHolder(View view) {
                super(view);
                thing_date = view.findViewById(R.id.thing_date);
                thing_name = view.findViewById(R.id.thing_name);
                btn_finish=view.findViewById(R.id.btn_finish);
                btn_finish.setOnClickListener( new View.OnClickListener() {
                    @Override
                    public void onClick(View v) {
                        int position=(int)v.getTag();
                        String name=mthingList.get( position ).getName();
                        mthingList.remove(position);//删除该按钮
                        adapter.notifyDataSetChanged();
                        Toast.makeText( MainActivity.this,"您删除掉了事件："+name,Toast.LENGTH_SHORT).show();
                    }
                } );
            }


            public void setdata(Thing thing,int position) {
                thing_date.setText(thing.getDate());
                thing_name.setText(thing.getName());
                btn_finish.setTag(position);
            }
        }

        public ThingAdapter(List<Thing> mthingList) {
            mThingList = mthingList;//传入数据源
        }
        
        @Override
        public ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
            //传入thing界面的内容
            //1.拿到thing见面的view
            //2.创建ViewHolder类型的view
            View view = View.inflate(parent.getContext(), R.layout.thing, null);
            return new ViewHolder(view);
        }

        @Override
        public void onBindViewHolder(ViewHolder holder, int position) {
            //这个方法用于绑定内部holder，用来设置数据
            Thing thing = mThingList.get(position);
            holder.setdata(thing,position);
        }

        @Override
        public int getItemCount() {
            return mThingList.size();
        }
    }

    public class Thing {
        //创建Thing类内含有thingname和thingdate两个属性
        private String thing_name;
        private String thing_date;
        public Thing(String thing_name,String thing_date){ //新建Thing类的方法
            this.thing_name=thing_name;
            this.thing_date=thing_date;
        }
        public String getName(){
            return thing_name;
        }
        public String getDate(){
            return thing_date;
        }
    }

    public void add_thing(String thing_name,String thing_date){
        //添加新的事件
        Thing new_thing=new Thing(thing_name,thing_date);
        SimpleDateFormat format = new SimpleDateFormat("yyyy-MM-dd");
        Date date1 = null;
        Date date2 = null;
//        int date_new = Integer.parseInt( thing_date.replaceAll("[[\\s-:punct:]]","") );
        if(mthingList.size()!=0)
        for(int i=0;i<mthingList.size();) {
                try {
                    date1 = format.parse( thing_date );
                    date2 = format.parse( mthingList.get( i ).thing_date );
                } catch (ParseException e) {
                    e.printStackTrace();
                }
                if (date1.before( date2 )) {
                    mthingList.add( i, new_thing );
                    break;
                }
                i++;
            if(i==mthingList.size()) {
                mthingList.add(new_thing);
                Log.v( "a","添加成功" );
                break;
            }
        }else mthingList.add(new_thing);//把新事件添加到list中去
        adapter.notifyDataSetChanged(); //更新
    }

    private void initThings(){
        //初始化事件
        LinearLayoutManager layoutManager=new LinearLayoutManager(this);//创建新的布局管理
        recyclerView.setLayoutManager(layoutManager);//在recycler中应用该布局管理器
        recyclerView.setAdapter(adapter);//在recycler中应用该适配器
    }
}

